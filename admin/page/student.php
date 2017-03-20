<?php

class page_student extends Page {
	function init(){
		parent::init();

		$tabs = $this->add('Tabs');

		$student_tab = $tabs->addTab('Students');
		$alumni_tab = $tabs->addTab('Alumnies');


		$student_crud = $student_tab->add('CRUD');
		$student_crud->setModel('Student',['name','email','gender','password','dob','address','contact_no','enrollment_mobile_no','current_city','current_state','current_country'],['name','current_city','running_courses']);
		$student_crud->addRef('PersonCourse');

		$alumni_crud = $alumni_tab->add('CRUD');
		$alumni_crud->setModel('Alumni',['name','email','gender','password','dob','address','contact_no','enrollment_mobile_no','current_employer','post_name','job_domain','current_city','current_state','current_country'],['name','current_city','current_employer','post_name']);
		$alumni_crud->addRef('PersonCourse');
	}
}