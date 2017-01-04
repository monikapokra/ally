<?php
	class page_registration extends Page{
		function init(){
			parent::init();

			$m = $form = $this->add('Form');
			$person = $this->add('Model_Person');

			$m->setModel($person,['type','name','email','password']);

			$form->addField('Password','re_password');				
			$type_field = $form->getElement('type');
			$form->addField('enrollment_no');
			$form->addSubmit('Submit');

			$type_field->js(true)->univ()->bindConditionalShow([
				'Student'=>['name','email','password','re_password','enrollment_no'],
				'Faculty'=>['name','email','password','re_password']
			],'div.atk-form-row');

			if($form->isSubmitted()){				
				if($form['password'] != $form['re_password'])
					$form->displayError('re_password','Password must match');

				// check for enrollment number validity

				$form->save();
				$form->js()->univ()->successMessage('Successfully registered')->execute();
			}
		}
	}