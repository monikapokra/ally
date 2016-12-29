<?php

class Model_StudentAbstract extends Model_Person {
	function init(){
		parent::init();

		$this->addExpression('running_courses_count')->set(function($m,$q){
			return $m->refSQL('PersonCourse')
						->addCondition('from_date','<', $this->app->today)
						->addCondition('to_date','>', $this->app->today)
						->count();
		});

		$this->addExpression('running_courses')->set(function($m,$q){
			$c = $m->add('Model_PersonCourse');
			$c->addCondition('person_id',$q->getField('id'));

			return $c->_dsql()->del('fields')
						->field($q->expr('GROUP_CONCAT([0])',[$c->getElement('course')]))
						;
		});

		$this->addCondition('type','Student');
	}
}