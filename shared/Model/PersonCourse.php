<?php

class Model_PersonCourse extends Model_MyTable {
	public $table ='person_course';

	function init(){
		parent::init();

		$this->hasOne('Course');
		$this->hasOne('Person');

		$this->addField('from_date')->type('date');
		$this->addField('to_date')->type('date');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}