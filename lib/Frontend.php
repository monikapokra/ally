<?php
class Frontend extends ApiFrontend {

    function init() {
        parent::init();        
        $this->dbConnect();

        $this->api->pathfinder
            ->addLocation(array(
                'addons' => ['vendor','shared/addons'],
                'php'=>['shared']
            ))
            ->setBasePath($this->pathfinder->base_location->getPath());
        asdasdds
        // Might come handy when multi-timezone base networks integrates
        $this->today = date('Y-m-d',strtotime($this->recall('current_date',date('Y-m-d'))));
        $this->now = date('Y-m-d H:i:s',strtotime($this->recall('current_date',date('Y-m-d H:i:s'))));

        $this->add('jUI'); 

        $m = $this->add('Menu',null,'Menu');
        $m->addItem('About','about');
        $m->addItem('Event','about');
        $m->addItem('Login');
        $m->addItem('Help');
    }
}
