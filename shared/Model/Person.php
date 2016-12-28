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