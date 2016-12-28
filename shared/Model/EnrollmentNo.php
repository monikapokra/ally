<?php

	class Model_EnrollmentNo extends Model_MyTable {
		public $table ="enrollment";

		function init() {
			parent:: init();

			$this->addField('enrolled_no');

			$this->is([
				'enrolled_no|to_trim|required'
			]);

			$this->add('dynamic_model/Controller_AutoCreator');
		}

	}