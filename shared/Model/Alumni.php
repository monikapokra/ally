<?php

class Model_Alumni extends Model_StudentAbstract {
	function init(){
		parent::init();

		$this->addCondition('running_courses_count', 0);
	}
}