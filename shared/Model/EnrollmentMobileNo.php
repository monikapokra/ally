<?php

	class Model_EnrollmentMobileNo extends Model_MyTable {
		
		public $table ="enrollment";

		function init() {
			parent:: init();

			$this->addField('name');
			$this->addField('enrolled_mobile_no');

			$this->is([
				'name|to_trim|required',
				'enrolled_mobile_no|to_trim|required'
			]);

			$this->add('dynamic_model/Controller_AutoCreator');
		}

	}