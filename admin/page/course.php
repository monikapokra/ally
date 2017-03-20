<?php

class page_course extends Page {
	function init(){
		parent::init();

			$cnrollment_crud = $this->add('CRUD');
			$cnrollment_crud->setModel('Course');
	}
}