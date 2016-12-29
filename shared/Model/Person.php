<?php

class Model_Person extends Model_MyTable{
	
	public $table = 'person';
	
	function init(){
		parent::init();
		
		$this->addField('name');
		$this->addField('password')->type('password');
		$this->addField('type')->enum(['Alumni','Student','Faculty']);
		$this->addField('email');
		$this->addField('gender')->enum(['Male','Female']);
		$this->addField('dob')->type('date');
		$this->addField('address')->type('text');
		$this->addField('contact_nos');
		$this->addField('current_employer');
		$this->addField('post_name');
		$this->addField('job_domain');
		$this->addField('current_city');
		$this->addField('current_state');
		$this->addField('current_country');

		$this->hasMany('PersonCourse');

		$this->is([
			'name|to_trim|required',
			'password|to_trim|required',
			'email|to_trim|required|email',
			'type|required',
			'gender|required',
			'contact_nos|required'
			]);

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}