<?php

class Model_Alumni extends Model_Person {
	function init(){
		parent::init();

		$this->addCondition('type','Alumni');
	}
}