<?php

class page_test extends Page {
	
	function init(){
		parent::init();

		$this->add('View_Box')->setHTML('Welcome to your new Web App Project. Get started by opening.');
		$this->add('HelloWorld');
		$this->add('Button')->set('Some Button')->addClass('atk-push atk-swatch-blue');
	
		$this->add('P')->set('This is my paragraph. We can add more text here.');
	}
}
