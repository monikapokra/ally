<?php

class Model_PersonCourse extends Model_MyTable {
	public $table ='person_course';

	function init(){
		parent::init();

		$this->hasOne('Course');
		$this->hasOne('Person');

		$this->addField('from_date')->type('date');
		$this->addField('to_date')->type('date');


		$this->addHook('beforeSave',[$this,'validateData']);
		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function validateData(){
		
		if(strtotime($this['from_date']) >= strtotime($this['to_date']))
			throw $this->exception('From Date must be smaller then to Date','ValidityCheck')->setField('from_date');

	}
}