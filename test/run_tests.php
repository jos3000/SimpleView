<?php

if(!file_exists('1/simpletest/VERSION') || file_get_contents('simpletest/VERSION') != '1.0.1'){
	die('simpletest 1.0.1 is missing. Try:
	

curl -L http://kent.dl.sourceforge.net/sourceforge/simpletest/simpletest_1.0.1.tar.gz -o '.LIBRARY_PATH.'simpletest_1.0.1.tar.gz;
mkdir -p '.LIBRARY_PATH.'simpletest_1.0.1/;
tar zxvf '.LIBRARY_PATH.'simpletest_1.0.1.tar.gz -C '.LIBRARY_PATH.'simpletest_1.0.1/;

'
	);
}

require_once('simpletest/unit_tester.php');
require_once('simpletest/reporter.php');


$included_files = array();

if(isset($argv[1])) {
	$included_files = array('root/'.$argv[1].'_test.php');
} else {

	$dir  = new DirectoryIterator('root'); 

	foreach ($dir as $file) { 
		$filename = $file->getFilename();
		if(strpos($filename,'_test.php')){
			$included_files[] = 'root/'.$filename;
		}
	}
	
}

$test = &new GroupTest('All tests');

foreach($included_files AS $file){
	$test->addTestFile($file);
}

$test->run(new TextReporter());


