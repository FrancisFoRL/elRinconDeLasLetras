<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class PaypalController extends Controller
{
    public function index()
    {
        return view('paypal.index');
    }

    public function RequestPayment(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $amount = $request->amount;

        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paymentsuccess'),
                'cancel_url' => route('paymentCancel'),
            ],
            'purchase_units' => [
                0 => [
                    'amount' => [
                        'currency_code' => 'EUR',
                        'value' => "$amount",
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }

            return redirect()->route('paymentindex')->with('error', 'Errores');
        }else{
            return redirect()->route('paymentindex')->with('error', $response['message'] ?? 'Errores2');
        }
    }

    public function PaymentSuccess(Request $request){
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if(isset($response['status']) && $response['status'] == 'COMPLETED'){
            return redirect()->route('paymentindex')->with('success', 'Pago completado');
        }else{
            return redirect()->route('paymentindex')->with('error', $response['message'] ?? 'Errores3');
        }
    }

    public function PaymentCancel(){
        return redirect()->route('paymentindex')->with('error', $response['message'] ?? 'Cancelastes el pago');
    }

}
