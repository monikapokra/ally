<?php

class Model_Faculty extends Model_Person {
	function init(){
		parent::init();

		$this->addCondition('type','Faculty');
	}
}