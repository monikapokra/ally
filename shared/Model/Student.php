<?php

class Model_Student extends Model_Person {
	function init(){
		parent::init();

		$this->addCondition('type','Student');
	}
}