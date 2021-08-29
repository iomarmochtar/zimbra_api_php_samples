<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;
use Zimbra\Enum\AccountBy;
use Zimbra\Admin\AdminFactory;
use Zimbra\Struct\AccountSelector;
use Zimbra\Struct\KeyValuePair;

class Helpers {

    // load configuration from .env file
    public static function initConfig(){
        $reqEnvs = ['ZIMBRA_SERVER', 'ADMIN', 'ADMIN_PWD', 'SAMPLE_USER', 'SAMPLE_COS'];
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $dotenv->required($reqEnvs);
        return new static;
    }

    public static function getZimbraAdmin(){
        $url = 'https://'.$_ENV['ZIMBRA_SERVER'].'/service/admin/soap';
        $api = AdminFactory::instance($url);
        $api->auth($_ENV['ADMIN'], $_ENV['ADMIN_PWD']);
        return $api;        
    }

    public static function convertKV($attrs){
        $_attrs = [];
        foreach($attrs as $k => $v){
            $_attrs[] = new KeyValuePair($k, $v);
        }
        return $_attrs;
    }

    public static function getValue($a, $key){
        foreach ($a as $r){
            if ($r->n == $key){
                return $r->_;
            }
        }
        
        return null;
    }

    public static function getAllCOS($api, $reversed=false){
        $result = [];
        foreach($api->getAllCOS()->cos as $cd){
            $result[$cd->id] = $cd->name;
        }

        // reverse cos name as key if reversed
        return $reversed ? array_flip($result) : $result;
    }

    public static function getAccountId($api, $email){
        $account = new AccountSelector(AccountBy::NAME(), $email);
        $acts = $api->getAccount($account, null, ['zimbraId']);
        return $acts->account->id;
    }
}
