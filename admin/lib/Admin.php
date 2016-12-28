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

    }

}