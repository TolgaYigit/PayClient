<?php

namespace App\Helpers;

use App\Models\Gateway;

class PaymentProcessor {
/*
    function __construct($gateway_id){
        $gateway = Gateway::findOrFail($gateway_id);
        $gateway = "App\\Services\\".$gateway->name."Service";
        dump($gateway);exit;
        return new $gateway;
    }*/

    public static function getService($gateway_id){
        $gateway = Gateway::findOrFail($gateway_id);
        $gateway = "App\\Services\\".$gateway->name."Service";
        return $gateway;
    }

}