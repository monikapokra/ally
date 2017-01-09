<?php

class page_profile extends Page{
	function init(){
		parent::init();

		$tabs = $this->add('Tabs');
		$profile_tab = $tabs->addTab('Profile');

		$user= $this->add('Model_Person')->load($this->app->auth->model->id);

		$form  = $profile_tab->add('Form');
		$form->setModel($user,['name','image_id','type','email','gender','dob','address','contact_nos','enrollment_no','teaching_course','password']);

		$type_field = $form->getElement('type');
		$type_field->js(true)->univ()->bindConditionalShow([
			'Student'=>['enrollment_no'],
			'Faculty'=>['teaching_course']
			],'div.atk-form-row');

		$form->getElement('enrollment_no')->setAttr('disabled',true);
		$form->getElement('address')->validate('required');
		
		$form->addField('Password','re_password');
		$form->addSubmit('Update');

		if($form->isSubmitted()){
			if($form['password'] != $form['re_password'])
				$form->displayError('re_password','Password must match');
			$form->model->getElement('enrollment_no')->destroy();
			$form->save();
			$form->js()->univ()->successMessage('Profile detail saved')->execute();
		}

		if($user['type']=='Faculty') return;
		
		$courses_tab = $tabs->addTab('Courses');
		$employement_tab = $tabs->addTab('Curent Job');

		$crud = $courses_tab->add('CRUD',['entity_name'=>'Course']);
		$crud->setModel($user->ref('PersonCourse'),['course_id','from_date','to_date'],['course','from_date','to_date']);

		$emp_form = $employement_tab->add('Form');
		$emp_form->setModel($user,['current_employer','post_name','job_domain','current_city','current_state']);
		$emp_form->addSubmit('Update');

		if($emp_form->isSubmitted()){
			$emp_form->save();
			$emp_form->js()->univ()->successMessage('Current employee detail saved')->execute();
		}
		
	}

}