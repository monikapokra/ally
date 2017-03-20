<?php

class page_findStudent extends Page {
	function init(){
		parent::init();

		$this->app->stickyGET('profile_page');

		$form = $this->add('Form')->addClass('ignore_changes');

		$s_grid = $this->add('Grid');

		$form->addField('DropDown','course')->setEmptyText('Please select')->validate('required')->setModel('Course');
		$form->addField('DropDown','year')->setEmptyText('Please select')->setValueList(['2012'=>'2012','2013'=>'2013','2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017']);

		$form->addSubmit('Get Students');

		$s_m = $this->add('Model_StudentAbstract');
		$s_c_j = $s_m->join('person_course.person_id');
		$s_c_j->addField('course_id');
		$s_c_j->addField('from_date');
		$s_c_j->addField('to_date');
		$s_m->addExpression('from_year')->set($s_m->dsql()->expr('YEAR([0])',[$s_m->getElement('from_date')]));
		$s_m->addExpression('to_year')->set($s_m->dsql()->expr('YEAR([0])',[$s_m->getElement('to_date')]));
		
		

		if($_GET['filter']){
			$s_m->addCondition('course_id',$_GET['course']);

			if($_GET['year']){
				$s_m->addCondition('from_year','<=',$_GET['year']);
				$s_m->addCondition('to_year','>=',$_GET['year']);
			}


		}else{			
			$s_m->addCondition('id',-1);
		}

		$s_grid->setModel($s_m,['name','enrollment_mobile_no','from_year','to_year']);

		$s_grid->on('click','tr',function($js,$data){
			if($_GET['profile_page']){	
				$this->app->memorize('profile_id',$data['id']);
				return [$js->_selector('.profile_view')->trigger('reload'),$this->js()->univ()->closeDialog()];
			}else{
				$student = $this->add('Model_Person')->load($data['id']);
				$str = $student['name']. ' ('.$student['enrollment_mobile_no'].')';
				return [$js->_selector('.selected_person')->html($str),$this->js()->_selector('.selected_person_id')->val($data['id']),$this->js()->univ()->closeDialog()];
			}
		});

		if($form->isSubmitted()){
			$s_grid->js()->reload(['filter'=>1,'course'=>$form['course'],'year'=>$form['year']])->execute();
		}
	}
}