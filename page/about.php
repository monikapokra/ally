<?php

class page_about extends Page {
	function init(){
		parent::init();

		$this->add('P')->set('This Project is Ally which means to Alumni Meet.');
		$this->add('P')->set('A group of people who have graduated or postgraduate from a school or university.');

		$this->add('P')->set('Alumni meet is a step towards creating multidimensional interactions between current and the pass out students of MCA MLSU.');

		$this->add('P')->set('The alumni of postgraduate studies Department of Computer Science MLSU are spread all over India.The Centre for postgraduate studies had no Alumni Association before. This website will help the alumni to stay in touch with the college and friends. It will also act as a bridge between alumni and current students.');
	}
}