<?php

class SimpleView {

	private $store = array();
	private $page;

	private $include_paths = array('.');
	private $extensions = array('','.php','.html.php');
	
	public function __construct($include_paths = false){
	    if($include_paths){
			if(!is_array($include_paths)) $include_paths = array($include_paths);
			$this->include_paths = array_merge($this->include_paths, $include_paths);
			
	    }
	}
	
	public function run($page, $template = false){
	
		$this->page = $page;
		$this->store = array(); # clean out the store
		
		if(!$template && isset($page['template'])) {
			$template = $page['template'];
		} elseif(!$template) {
			throw new Exception('Template not defined');
		}
		
		return $this->inc($template);
	}
	
	private function inc($template, $current = false){
		
		$__ = $this->page;
		
		if($current !== false){
			$_ = $current;
		} else {
			$_ = $__;
		}
		
		unset($current);
		
		ob_start();
		require($this->resolvePath($template));
		$return = ob_get_contents();
		ob_end_clean();
		return $return;
	
	}
	
	private function store($name){
	
		$this->store[$name] = ob_get_contents();
		ob_end_clean();
		ob_start();
	
	}
	
	private function retrieve($name){
		if(isset($this->store[$name])) return $this->store[$name];
	
	}
	
    private function resolvePath($template){

		foreach($this->include_paths AS $p){
			foreach($this->extensions AS $e){
				$t = $p.'/'.$template.$e;
				if(file_exists($t)) return $t;
			}
		}
		
		# template not found - throw Exception
		throw new Exception('Template for ['.$template.'] not found.');
		
	}
	

}
