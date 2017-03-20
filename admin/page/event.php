<?php
class page_event extends Page{
	public $title="Events";
	function init(){
		parent::init();

		$this->add('CRUD')->setModel('Event');
	}
}