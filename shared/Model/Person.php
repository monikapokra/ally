<?php

class Model_Person extends Model_MyTable{
	
	public $table = 'person';
	
	function init(){
		parent::init();
		
		$this->addField('name');
		$this->addField('password')->type('password');
		$this->addField('type')->enum(['Student','Faculty']);
		$this->addField('email');
		$this->addField('gender')->enum(['Male','Female']);
		$this->addField('dob')->type('date');
		$this->addField('address')->type('text');
		$this->addField('contact_nos');
		$this->addField('enrollment_no');
		$this->addField('current_employer');
		$this->addField('post_name');
		$this->addField('job_domain');
		$this->addField('current_city');
		$this->addField('current_state');
		$this->addField('current_country');
		$this->addField('teaching_course');
		$this->addField('is_admin')->type('boolean')->defaultValue(false)->system(true);

		$this->hasMany('PersonCourse');

		$this->is([
			'name|to_strip_extra_space|to_trim|required|alphaspace',
			'password|to_trim|required',
			'email|to_trim|required|email',
			'type|required',
			'gender|required',
			'contact_nos|required',
			'address|required',
			]);

		$this->addHook('beforeSave',[$this,'validatData']);

		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function validatData(){
		if($this['type']=='Student' && date('Y',strtotime($this['dob'])) >= 2000)
			throw $this->exception('Students birth year does not looks acceptable','ValidityCheck')->setField('dob');

		$password_len = strlen($this['password']);
		if($password_len<6 || $password_len > 12)
			throw $this->exception('Password must be of length 6 to 12','ValidityCheck')->setField('password');

		if(strlen($this['contact_nos']) > 0 AND strlen($this['contact_nos']) != 10)
			throw $this->exception('Contact number must be of 10 digit long','ValidityCheck')->setField('contact_nos');
	
		if(strlen(trim($this['address'])) >0 AND strlen(trim($this['address']))<=20)
			throw $this->exception('Address must be of length 20 or more','ValidityCheck')->setField('address');
		
	}
}