<?php

class page_index extends Page {
	function init(){
		parent::init();

		$m = $this->add('Model_Student');
		$this->add('CRUD')->setModel($m);

		$m = $this->add('Model_Teacher');
		$this->add('CRUD')->setModel($m);

		$m = $this->add('Model_Course');
		$this->add('CRUD')->setModel($m);

		$m = $this->add('Model_Event');
		$this->add('CRUD')->setModel($m);

		$m = $this->add('Model_EventCourse');
		$this->add('CRUD')->setModel($m);

		$m = $this->add('Model_Message');
		$this->add('CRUD')->setModel($m);

		$m = $this->add('Model_EnrollmentNo');
		$this->add('CRUD')->setModel($m);
	}
}