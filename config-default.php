<?php
$config['url_prefix']='?page=';
$config['url_postfix']='';

// $config['locale']['date_js'] = 'dd/mm/yyyy';

// $config['js']['versions']['jqueryui']='1.11.master';

// $config['tmail']['transport'] = 'Echo';


$config['dsn']='mysql://root:@localhost/ally';

// $config['tmail']['transport']='phpmailer';
$config['tmail']['transport']='Echo';
$config['tmail']['from']='no-reply@mlsualumni.com';

$config['tmail']['phpmailer'] = [

    'encryption'=>'tsl',   // only smtp-tsl is supported currently
    'username'=>'email@username.com',
    'password'=>'password',
    'host'=>'mail.host.com',
    'from_email'=>'no-reply@mlsualumni.com',
    'from_name'=>'Ally Admin',

    // optional: 'port'=>'smtp port',
];