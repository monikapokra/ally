<?php

class Model_Student extends Model_StudentAbstract {
	function init(){
		parent::init();

		$this->addCondition('running_courses_count','>', 0);
	}
}