<?php

class page_resetpassword extends Page {
	
	function init(){
		parent::init();

		$form = $this->add('Form');
		$form->addField('email')->set($this->app->stickyGET('email'));
		$form->addField('otp')->set($this->app->stickyGET('otp'));
		$form->addField('Password','new_password');

		$form->addSubmit('Reset Password');

		if($form->isSubmitted()){
			$model = $this->add('Model_Person')->tryLoadBy('email',$form['email']);
			if(!$model->loaded()) $form->displayError('email','This is not a registered user');

			if($model['otp'] !=$form['otp'])
				$form->displayError('otp','Invalid OTP');

			$model['password'] = $form['new_password'];
			$model->save();

			$form->js()->reload()->univ()->redirect('login')->execute();
		}
	}
}