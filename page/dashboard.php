<?php

class page_dashboard extends Page {
	
	function init(){
		parent::init();
	
		/**For add in template**/
		// $this->add('View')->set('New User?');
		
		// $form = $this->add('Form');

		// $form -> addField('email')->validate('required');
		// $form -> addField('password','password')->validate('required');

		// $form -> addSubmit('Sign In')->addClass('atk-push-small');

		// $this->auth = $this->add('Auth');
  //       $this->auth->setModel('Person','email','password');
  //       $this->auth->check();

	}

	// function defaultTemplate(){
	// 	return['signin'];
	// }

}
