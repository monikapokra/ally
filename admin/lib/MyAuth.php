<?php


class MyAuth extends BasicAuth {
	function showLoginForm(){

        $this->app->template->trySet('page_title','Login');
        if($this->app->layout && $this->login_layout_class){
            $this->app->layout->destroy();
            $this->app->add($this->login_layout_class);
            $this->app->page_object=$p=$this->app->layout->add('Page',null,null,array('page/login'));
        }else{
            $this->app->page_object=$p=$this->app->add('Page',null,null,array('page/mylogin'));
        }


        // hook: createForm use this to build basic login form
        $this->form=$this->hook('createForm',array($p));

        // If no hook, build standard form
        if(!is_object($this->form))
            $this->form=$this->createForm($p);


        $this->hook('updateForm');
        $f=$this->form;
        if($f->isSubmitted()){
            $id = $this->verifyCredentials($f->get('username'), $f->get('password'));
            if($id){
                $this->loginByID($id);
                $this->loggedIn($f->get('username'),$f->get('password'));
                exit;
            }
            $f->getElement('password')->displayFieldError('Incorrect login information');
        }
        return $p;
    }
}