<?php

class page_faculty extends Page {
	function init(){
		parent::init();

			$faculty_crud = $this->add('CRUD');
			$faculty_crud->setModel('Faculty',['name','email','gender','password','dob','address','contact_no','running_courses','current_city','current_state','current_country'],['name','email','contact_nos']);
	}
} 
	