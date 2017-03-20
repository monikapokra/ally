<?php

class page_dashboard extends Page {
	
	function init(){
		parent::init();
		
		$this->app->auth->model->reload();
		$this->setModel($this->app->auth->model);

		$tabs = $this->add('Tabs',null,'messages');

		$in_tab = $tabs->addTab('Inbox');
		$sent_tab = $tabs->addTab('Sent');

		$my_in_message = $this->add('Model_Message');
		$my_in_message->addCondition('to_id',$this->app->auth->model->id);

		$my_sent_message = $this->add('Model_Message');
		$my_sent_message->addCondition('from_id',$this->app->auth->model->id);

		$m_in_grid = $in_tab->add('Grid');
		$m_in_grid->setModel($my_in_message,['created_at','from']);

		$m_in_grid->addColumn('button','read');

		if($id = $_GET['read']){
			$read_message_m = $this->add('Model_Message')->load($id);
			$read_message_m->markRead();
			$this->js()->univ()->dialogOK('Message',$read_message_m['message'])->execute();
		}

		$m_sent_grid = $sent_tab->add('Grid');
		$m_sent_grid->setModel($my_sent_message,['to','message','created_at','is_read']);

		$m_form = $this->add('Form',null,'new_message_form',['form/stacked']);
		$btn_set = $m_form->add('ButtonSet');
		$student_btn = $btn_set->addButton('To Student');
		$faculty_btn = $btn_set->addButton('To Faculty');
		$m_form->add('View')->addClass('selected_person')->set('Select Any Person');
		$m_form->addField('Hidden','to_person_id')->addClass('selected_person_id');
		$m_form->addField('Text','message');
		$m_form->addSubmit('Send');

		if($student_btn->isClicked()){
			$this->js()->univ()->frameURL('Find Student',$this->app->url('findStudent'))->execute();
		}

		if($faculty_btn->isClicked()){
			$this->js()->univ()->frameURL('Find Faculty',$this->app->url('findFaculty'))->execute();
		}

		if($m_form->isSubmitted()){

			$message = $this->add('Model_Message');
			$message['from_id']=  $this->app->auth->model->id;
			$message['to_id']=  $m_form['to_person_id'];
			$message['message'] = $m_form['message'];
			$message->save();

			$m_form->js(null,[$m_form->js()->reload(),$m_in_grid->js()->reload(),$m_sent_grid->js()->reload()])->univ()->successMessage('Message Sent')->execute();

		}

		$this->add('Button',null,'edit_profile_btn')->set('Edit Profile')->js('click')->univ()->redirect('editprofile');

	}

	function defaultTemplate(){
		return ['page/dashboard'];
	}

}
