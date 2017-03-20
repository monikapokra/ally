<?php

class View_Profile extends View {
	function init(){
		parent::init();
		$id=$this->app->recall('profile_id',false);
		
		if(!$id){
			// $this->add('View')->set('Please select');
			$this->template->trydel('info');
			return;
		}

		$model = $this->add('Model_Person')->load($id);
		$this->setModel($model);

	}

	function defaultTemplate(){
		return ['view/profile'];
	}
}