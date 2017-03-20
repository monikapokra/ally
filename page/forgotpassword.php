<?php

class page_forgotpassword extends Page {
	
	function init(){
		parent::init();

		$form = $this->add('Form');
		$form->addField('email');

		$form->addSubmit('Get Password');

		if($form->isSubmitted()){
			$model = $this->add('Model_Person')->tryLoadBy('email',$form['email']);
			if(!$model->loaded()) $form->displayError('email','This is not a registered user');

			$model['otp']=rand(100000,999999);
			$model->save();

			$mail = $this->add('GiTemplate')->loadTemplate('mail/forgotpassword');
			$mail->set($model->get());

			$mail->set('reset_url',$this->app->url('resetpassword',['otp'=>$model['otp'],'email'=>$model['email']])->absolute());

			$tmail = $this->add('Tmail');
			$tmail->set('subject','Password recovery email');
			$tmail->setHTML($mail->render());
			$tmail->send($form['email']);

			$form->js()->reload()->univ()->successMessage('Please check your email')->execute();
		}
	}
}