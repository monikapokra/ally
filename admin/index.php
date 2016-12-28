<?php

require_once'../vendor/autoload.php';
require_once 'lib/Admin.php';

$api=new Admin('front');
$api->main();