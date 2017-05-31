<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;
use App\Models\Gateway;
use App\Models\Payment;

use Validator;

class HomeController extends Controller
{
    public function payment(Request $request){
        $currencies = config('currencies');

        //$payment = Gateway::with('payments')->first();
        //dump($payment);exit;

        $gateways = Gateway::where('status', 1)->pluck('name', 'id')->toArray();

        if ($request->isMethod('post')) {

            //validation
            $validate_payment = Validator::make($request->input(), [
                'name' => 'required',
                'email' => 'required',
                'gateway_id' => 'required',
                'base_value' => 'required',
                'currency' => 'required'
            ]);

            if ($validate_payment->fails()) {
                return redirect()
                    ->route('payment')
                    ->withErrors($validate_payment)
                    ->withInput();
            }


            //Check if currency and gateway exist
            if(array_key_exists($request->currency, $currencies) && array_key_exists($request->gateway_id, $gateways)){
                $gateway = Gateway::findOrFail($request->gateway_id);

                //Calculating the transaction value
                if($request->currency == $gateway->default_currency){
                    $transaction_value = $request->payment_value;
                } else {
                    $transaction_value = $request->base_value * $gateway->exchange_rate;
                }

                //saving payment options
                $payment = new Payment();
                $payment->name = $request->name;
                $payment->email = $request->email;
                $payment->gateway_id = $request->gateway_id;
                $payment->base_value = $request->base_value;
                $payment->currency = $request->currency;
                $payment->status = 'pending';
                $payment->save();

                $service = new \App\Services\PaymentService($payment);
                $service->checkCurrency();
                if($service->pay() == 'success'){
                    $payment->status = 'completed';
                    $payment->save();
                    $service->sendVoucher($payment);
                }

                return redirect()->route('paymentStatus', ['payment_id' => $payment->id]);
            } else {
                //dump('false');
            }
        }

        return view('payment', compact('currencies', 'gateways'));
    }

    public function paymentStatus(Request $request, $payment_id){
        $payment = Payment::with('gateway')->findOrFail($payment_id);

        return view('paymentStatus', compact('payment'));
    }
}
