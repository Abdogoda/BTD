<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller{
    public function payment(){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => 'CAPTURE',
            "application_context" => [
                "return_url" => route('payment.success'),
                "cancel_url" => route('payment.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => "10"
                    ]
                ]
            ]
        ]);
        if(isset($response['id']) && $response['id'] != null){
            foreach ($response['links'] as $link) {
                if($link['rel'] == 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        }else{
            return redirect()->route('payment.cancel');
        }
    }
    public function cancel(){
        return "402 Payment Cancelled";
    }
    public function success(Request $request){
        dd($request);
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        dd($response);
        if(in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])){
            return "200 Payment Success";
        }else{
            return "400 Payment Faild";
        }
    }
}