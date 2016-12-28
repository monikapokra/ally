<?php

class Model_Teacher extends Model_Person {
	function init(){
		parent::init();

		$this->addCondition('type','Teacher');
	}
}