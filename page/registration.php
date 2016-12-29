<?php
	class page_registration extends Page{
		function init(){
			parent::init();

			$m = $form = $this->add('Form');
			$m->setModel('Person',['type','name','email','password']);

			$form->addField('Password','re_password');
			$form->addField('enrollment_no');
			$form->addSubmit('Submit');

			if($form->isSubmitted()){
			if($form['password'] != $form['re_password'])
				$form->displayError('re_password','Password must match');

				// check for enrollment number validity

				$form->save();
				$form->js()->univ()->successMessage('Successfully registered')->execute();
			}
		}
	}