<?php
	class page_event extends Page{
	function init(){
		parent::init();

		$form = $this->add('Form');
		$grid = $this->add('Grid');
		$year_field = $form->addField('DropDown','filter_events')->setValueList(['All','2016'=>'2016','2017'=>'2017']);
		$year_field->js('change',$form->js()->submit());

		if($form->isSubmitted()){
			$grid->js()->reload(['year'=>$form['filter_events']])->execute();
		}

		$events = $this->add('Model_Event');

		if($_GET['year']){
			$events->addCondition('year',$_GET['year']);
		}

		$grid->setModel($events);
	}
}
