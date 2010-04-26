<?php

class SimpleView {

	private $store = array();
	private $page;
	private $current;
	private $include_paths = array('.');
	private $extensions = array('','.php','.html.php');
	
	public function __construct($include_paths == false){
	    if($include_paths){
	        $this->include_paths = array_merge($this->include_paths, $include_paths);
	    }
	}
	
	public function run($page, $template == false){
	
		$this->current = $this->page = $page;
		$this->store = array(); # clean out the store
		
		if(!$template && isset($page['template'])) $template = $page['template'];
		else throw new Exception('Template not defined');
		
		return $this->include($template);
	}
	
	private function include($template, $current = false){
		
		if($current !== false){
			$this->current = $current;
		}
		
		unset($current);
		
		$_ = $this->current;
		$__ = $this->page;
		
		ob_start()
		require($this->resolvePath($template));
		return ob_end_clean();
	
	}
	
	private function store($name){
	
		$store['name'] = ob_end_clean();
		ob_start();
	
	}
	
	private function retrieve($name){
		if(isset($store['name'])) return $store['name'];
	
	}
	
    private function resolvePath($template){
        foreach($this->include_paths AS $p){
            foreach($this->extensions AS $e){
                $t = $p.'/'.$template.$e;
                if(file_exists($t)) return $t;
            }
        }
        
    }	

}
