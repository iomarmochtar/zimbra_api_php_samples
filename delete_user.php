<?php

require_once './helpers.php';

$api = Helpers::initConfig()->getZimbraAdmin();

$email = $_ENV['SAMPLE_USER'];
$accountId = Helpers::getAccountId($api, $email);
$api->deleteAccount($accountId);
echo "$email is deleted\n";
