<?php

class Model_Event extends Model_MyTable {
	public $table = "event";

	function init(){
		parent::init();

		$this->addField('name');
		$this->addField('description')->type('text');
		$this->addField('date')->type('date');


		$this->is([
				'name|to_trim|required'
			]);

		$this->add('dynamic_model/Controller_AutoCreator');
	}
}