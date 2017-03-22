<?php

class Model_Person extends Model_MyTable{
	
	public $table = 'person';
	
	function init(){
		parent::init();
		
		$this->addField('name');
		$this->add('filestore/Field_Image','image_id');
		$this->addField('password')->type('password');
		$this->addField('type')->enum(['Student','Faculty']);
		$this->addField('email');
		$this->addField('gender')->enum(['Male','Female']);
		$this->addField('dob')->type('date');
		$this->addField('address')->type('text');
		$this->addField('contact_nos');
		$this->addField('enrollment_mobile_no');
		$this->addField('current_employer');
		$this->addField('post_name');
		$this->addField('job_domain');
		$this->addField('current_city');
		$this->addField('current_state');
		$this->addField('current_country');
		$this->addField('teaching_course');
		$this->addField('is_admin')->type('boolean')->defaultValue(false)->system(true);

		$this->addField('otp');

		$this->hasMany('PersonCourse');

		$this->addExpression('unread_message_count')->set(function($m,$q){
			return $this->add('Model_Message')
						->addCondition('to_id',$q->getField('id'))
						->addCondition('is_read',false)->count();
		});

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

		// $this->add('dynamic_model/Controller_AutoCreator');
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

		if(!$this->validEmail($this['email']))
			throw $this->exception('Email is not valid','ValidityCheck')->setField('email');


		if($this['type']==='Student' AND $this->loaded() AND $this['enrollment_mobile_no'] ){
			$old_student = $this->add('Model_Person')
								->addCondition('enrollment_mobile_no',$this['enrollment_mobile_no'])
								->addCondition('id','<>',$this->id)
								->tryLoadAny();
			if($old_student->loaded()){
				throw $this->exception('This enrollment number is already in system.','ValidityCheck')->setField('enrollment_mobile_no')->addMoreInfo('enrollment_mobile_no',$this['enrollment_mobile_no']);
			}
			
		}
		
	}

	function validEmail($email){

		$email_array = explode("@", $email);
		$local_array=explode(".", $email_array[1]);
		if(is_numeric($local_array[0])) return false;

	    if(is_array($email) || is_numeric($email) || is_bool($email) || is_float($email) || is_file($email) || is_dir($email) || is_int($email))
	        return false;
	    else
	    {
	        $email=trim(strtolower($email));
	        if(filter_var($email, FILTER_VALIDATE_EMAIL)===true) return $email;
	        else
	        {
	            $pattern = '/^(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){255,})(?!(?:(?:\\x22?\\x5C[\\x00-\\x7E]\\x22?)|(?:\\x22?[^\\x5C\\x22]\\x22?)){65,}@)(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22))(?:\\.(?:(?:[\\x21\\x23-\\x27\\x2A\\x2B\\x2D\\x2F-\\x39\\x3D\\x3F\\x5E-\\x7E]+)|(?:\\x22(?:[\\x01-\\x08\\x0B\\x0C\\x0E-\\x1F\\x21\\x23-\\x5B\\x5D-\\x7F]|(?:\\x5C[\\x00-\\x7F]))*\\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-+[a-z0-9]+)*\\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-+[a-z0-9]+)*)|(?:\\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\\]))$/iD';
	            return (preg_match($pattern, $email) === 1) ? $email : false;
	        }
	    }

	    return true;
	}
}