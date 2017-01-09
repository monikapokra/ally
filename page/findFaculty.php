<?php

class page_findFaculty extends Page {
	function init(){
		parent::init();

		$form = $this->add('Form');

		$f_grid = $this->add('Grid');

		$form->addField('DropDown','course')->setEmptyText('Please select')->validate('required')->setModel('Course');
		$form->addField('DropDown','year')->setEmptyText('Please select')->setValueList(['2012'=>'2012','2013'=>'2013','2014'=>'2014','2015'=>'2015','2016'=>'2016','2017'=>'2017']);

		$form->addSubmit('Get Students');
		
		$f_m = $this->add('Model_Faculty');
		$f_c_j = $f_m->join('person_course.person_id');
		$f_c_j->addField('from_date');
		$f_c_j->addField('to_date');
		$f_m->addExpression('from_year')->set($f_m->dsql()->expr('YEAR([0])',[$f_m->getElement('from_date')]));
		$f_m->addExpression('to_year')->set($f_m->dsql()->expr('YEAR([0])',[$f_m->getElement('to_date')]));
		
		$f_c_j->addField('course_id');


		if($_GET['filter']){

			if($_GET['year']){
				$f_m->addCondition('from_year','<=',$_GET['year']);
				$f_m->addCondition('to_year','>=',$_GET['year']);
			}

			$f_m->addCondition('course_id',$_GET['course']);


		}else{			
			$f_m->addCondition('id',-1);
		}

		$f_grid->setModel($f_m,['name']);

		$f_grid->on('click','tr',function($js,$data){
			$faculty = $this->add('Model_Person')->load($data['id']);
			$str = $faculty['name'];
			return [$js->_selector('.selected_person')->html($str),$this->js()->_selector('.selected_person_id')->val($data['id'])];
		});

		if($form->isSubmitted()){
			$f_grid->js()->reload(['filter'=>1,'course'=>$form['course'],'year'=>$form['year']])->execute();
		}
	}
}