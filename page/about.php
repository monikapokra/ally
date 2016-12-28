<?php

class page_about extends Page {
	function init(){
		parent::init();

		$this->add('P')->set('This Project is Ally which means to Alumni Meet.');
		$this->add('P')->set('A group of people who have graduated from a school or university. Alumni is usually used to refer to a group of graduates of either one or both genders, while ‘alumnus’ traditionally refers to a single male graduate, with the feminine term being ‘alumna’.');

		$this->add('P')->set('Alumni meet is a step towards creating multidimensional interactions between current and the pass out students of MCA MLSU.');

		$this->add('P')->set('The alumni of Department of Computer Science for postgraduate studies, MLSU are spread all over India. Many of them have splendid accomplishments to their credit in their personal and professional fields, bringing laurels to their Alma Mater. The Centre for postgraduate studies had no Alumni Association before. This website will help the alumni to stay in touch with the college and friends. It will also act as a bridge between alumni and current students.');
	}
}