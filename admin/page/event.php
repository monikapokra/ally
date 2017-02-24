<?php
	class page_event extends Page{
	function init(){
		parent::init();

		$this->add('CRUD')->setModel('Event');
	}
}