<?php

class page_enrollment extends Page {
	function init(){
		parent::init();

			$cnrollment_crud = $this->add('CRUD');
			$cnrollment_crud->setModel('EnrollmentNo',['enrolled_no']);
	}
} 