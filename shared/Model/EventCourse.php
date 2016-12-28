<?php

class Model_EventCourse extends Model_MyTable {
	public $table ='event_course';

	function init(){
		parent::init();

		$this->hasOne('Course');
		$this->hasOne('Event');

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}