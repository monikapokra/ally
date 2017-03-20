<?php

class Model_Message extends Model_MyTable {
	public $table = "message";

	function init(){
		parent::init();

		$this->hasOne('Student','to_id');
		$this->hasOne('Student','from_id');
		
		$this->addField('message')->type('text');

		$this->addField('created_at')->type('date')->defaultValue(date('Y-m-d'));
		$this->addField('is_read')->type('boolean')->defaultValue(false);


		$this->add('dynamic_model/Controller_AutoCreator');
	}

	function markRead(){
		$this['is_read']= true;
		$this->save();
	}
}