<?php

require_once './helpers.php';

$api = Helpers::initConfig()->getZimbraAdmin();

$email = $_ENV['SAMPLE_USER'];
$accountId = Helpers::getAccountId($api, $email);

$coses = Helpers::getAllCOS($api, true);
$cosName = $_ENV['SAMPLE_COS'];

// attributes that will be changed
$attrs = [
    'givenName'=>'firstName', 
    'sn'=>'lastName', 
    'zimbraCOSId'=>$coses[$cosName]
];
$api->modifyAccount($accountId, Helpers::convertKV($attrs));

echo "modified\n";
