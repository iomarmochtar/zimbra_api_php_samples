<?php

require_once './helpers.php';

// random string for password
function rand_string( $length ) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    return substr(str_shuffle($chars),0,$length);

}

$api = Helpers::initConfig()->getZimbraAdmin();

$email = $_ENV['SAMPLE_USER'];

$coses = Helpers::getAllCOS($api, true);
$cosName = $_ENV['SAMPLE_COS'];

// user attributes
$attrs = [
    'givenName'=>'first', 
    'sn'=>'last', 
    'zimbraCOSId'=>$coses[$cosName]
];

$password = rand_string(8);
$api->createAccount($email, $password, Helpers::convertKV($attrs));

echo "$email is created\n";
