<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\Gateway;
use App\Helpers\PaymentProcessor;

use Mail;
use App\Mail\PaymentSuccess;

class PaymentService {

    public $paymentService;
    public $payment;

    public $default_currency;
    public $exchange_rate;

    function __construct($payment)
    {
        $service = PaymentProcessor::getService($payment->gateway_id);
        $this->paymentService = new $service;
        $this->payment = $payment;

        $gateway = Gateway::findOrFail($payment->gateway_id);

        $this->default_currency = $gateway->default_currency;
        $this->exchange_rate = $gateway->exchange_rate;

    }

    public function checkCurrency(){
        if($this->payment->currency != $this->default_currency){
            $this->payment->transection_value = $this->payment->base_value * $this->exchange_rate;
        } else {
            $this->payment->transection_value = $this->payment->base_value;
        }
        $this->payment->save();
    }

    public function pay(){
        return $this->paymentService->pay($this->payment);
    }

    public function sendVoucher($payment){
        Mail::to($payment->email)
            ->send(new PaymentSuccess($payment));
    }
}