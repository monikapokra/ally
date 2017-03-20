<?php

class Admin extends App_Frontend {

    function init() {
        parent::init();

        $this->dbConnect();
        $this->add('jUI');

        $this->api->pathfinder
            ->addLocation(array(
                'addons' => array('vendor','shared/addons'),
                'php'=>['shared']
            ))
            ->setBasePath($this->pathfinder->base_location->getPath() . '/..');

         // Might come handy when multi-timezone base networks integrates
        $this->today = date('Y-m-d',strtotime($this->recall('current_date',date('Y-m-d'))));
        $this->now = date('Y-m-d H:i:s',strtotime($this->recall('current_date',date('Y-m-d H:i:s'))));


        $auth = $this->add('Auth');
        $auth->setModel('Admin','email','password');
        $auth->check();

        $m = $this->add('Menu',null,'Menu');
        $m->addItem('Dashboard','index');
        $m->addItem('Student','student');
        $m->addItem('Faculty','faculty');
        $m->addItem('Event','event');
        $m->addItem('Enrollment','enrollment');
        $m->addItem('Course','course');
       

    }

}