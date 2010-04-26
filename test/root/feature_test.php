<?php

class TestOfSimpleView extends UnitTestCase {

	function testExample() {

        $view = new SimpleView();
        
        $data = require('example/page_1.php');
        $output = $view->run($data);

	    $this->assertEqual($output, file_get_contents('example/output_1.html');

	}
}
