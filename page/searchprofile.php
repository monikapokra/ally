<?php
class page_searchprofile extends Page {
	function init(){
		parent::init();
		
		$btn_set = $this->add('ButtonSet');
		$student_btn = $btn_set->addButton('Search Student');
		$faculty_btn = $btn_set->addButton('Search Faculty');

		if($student_btn->isClicked()){
			$this->js()->univ()->frameURL('Find Student',$this->app->url('findStudent',['profile_page'=>true]))->execute();
		}

		if($faculty_btn->isClicked()){
			$this->js()->univ()->frameURL('Find Faculty',$this->app->url('findFaculty',['profile_page'=>true]))->execute();
		}

		$this->add('View_Profile')->js('reload')->reload();

	}
}