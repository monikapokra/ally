<?php
	class page_registration extends Page{
		function init(){
			parent::init();


			$m = $form = $this->add('Form',null,'form');
			$m->addClass('registration_module');
			$person = $this->add('Model_Person');

			$m->setModel($person,['type','name','email','enrollment_mobile_no','password']);

			$form->addField('Password','re_password');				
			$type_field = $form->getElement('type');
			$form->addSubmit('Submit');

			$type_field->js(true)->univ()->bindConditionalShow([
				'Student'=>['name','email','password','re_password','enrollment_mobile_no'],
				'Faculty'=>['name','email','password','re_password']
			],'div.atk-form-row');

			if($form->isSubmitted()){				
				if($form['password'] != $form['re_password'])
					$form->displayError('re_password','Password must match');

				if($form['type']=='Student' && !$form['enrollment_mobile_no'])
					$form->displayError('enrollment_mobile_no','Please provide enrollment number.');
				
				// check for enrollment mobile number validity
				$enm = $this->add('Model_EnrollmentMobileNo');
				$enm->addCondition('enrolled_mobile_no',$form['enrollment_mobile_no'])
					->tryLoadAny();

				if(!$enm->loaded() AND $form['type'] != 'Faculty')
					$form->displayError('enrollment_mobile_no','This Mobile number does not exists');

				$existing_person = $this->add('Model_Person');
				$existing_person->tryLoadBy('enrollment_mobile_no',$form['enrollment_mobile_no']);

				if($existing_person->loaded() && $form['type']==='Student'){
					$form->displayError('enrollment_mobile_no','This Enrollment number is already registered');
				}

				$form->save();
				$form->js(null,$form->js()->univ()->redirect('dashboard'))->univ()->successMessage('Successfully registered')->execute();
			}
			$this->js(true)->_selector('.atk-content')->addClass('bgimage');
		}

	function defaultTemplate(){
		return['page/registration'];
	}	
}