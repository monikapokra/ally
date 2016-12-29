<?php

class Model_Admin extends Model_Person {
	function init(){
		parent::init();

		$this->addCondition('is_admin',true);

		$this->add('Button')->set('Alumni');
	}
}