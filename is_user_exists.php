<?php

use Zimbra\Struct\AccountSelector;
use Zimbra\Enum\AccountBy;
require_once './helpers.php';

$api = Helpers::initConfig()->getZimbraAdmin();

$email = $_ENV['SAMPLE_USER'];

// search user 
$query = "mail=$email";
$searchResult = $api->searchAccounts($query, 1, 1);

// if the returned email is not zero then the user exists
// we can do something to it. eg: get user ID
// since we cannot do directly in getAccount because once the account is not exists it will returning http code 500 (server error), the detail can only be seen in mailbox log file
if ($searchResult->searchTotal != 0){
    $account = new AccountSelector(AccountBy::NAME(), $email);
    $acts = $api->getAccount($account);
    $userID = $acts->account->id;

    $cosID = Helpers::getValue($acts->account->a, 'zimbraCOSId');
    $coses = Helpers::getAllCOS($api);

    // if not in list then it refer to default cos
    $cos = array_key_exists($cosID, $coses) ? $coses[$cosID] : 'default'; 

    echo "$email is using cos $cos\n";
} else {
    echo "user with email $email is not found !!!\n";
}

