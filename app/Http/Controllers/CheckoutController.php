<?php

namespace App\Http\Controllers;

use Cartalyst\Stripe\Laravel\Facades\Stripe as Stripe;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{
    public function index()
    {
        $provincias = array("Álava", "Albacete", "Alicante", "Almería", "Asturias", "Ávila", "Badajoz", "Barcelona", "Burgos", "Cáceres", "Cádiz", "Cantabria", "Castellón", "Ciudad Real", "Córdoba", "Cuenca", "Gerona", "Granada", "Guadalajara", "Guipúzcoa", "Huelva", "Huesca", "Islas Baleares", "Jaén", "La Coruña", "La Rioja", "Las Palmas", "León", "Lérida", "Lugo", "Madrid", "Málaga", "Murcia", "Navarra", "Orense", "Palencia", "Pontevedra", "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia", "Valladolid", "Vizcaya", "Zamora", "Zaragoza");
        return view('paypal.index', compact('provincias'));
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
                        'value' => Cart::subtotal()+4.99,
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

            return redirect()->route('checkout')->with('error', 'Errores');
        } else {
            return redirect()->route('checkout')->with('error', $response['message'] ?? 'Error en la cantidad de pago');
        }
    }

    public function PaymentSuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request['token']);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            return redirect()->route('checkout')->with('success', 'Pago completado');
        } else {
            return redirect()->route('checkout')->with('error', $response['message'] ?? 'Errores3');
        }
    }

    public function PaymentCancel()
    {
        return redirect()->route('checkout')->with('error', $response['message'] ?? 'Cancelastes el pago con Paypal');
    }

    public function PaymentStripe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            // 'amount' => 'required',
        ]);

        $input = $request->except('_token');

        if ($validator->passes()) {
            $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);

                if (!isset($token['id'])) {
                    return redirect()->route('stripe.add.money');
                }

                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'EUR',
                    'amount' => Cart::subtotal()+4.99,
                    'description' => 'wallet',
                ]);

                if ($charge['status'] == 'succeeded') {
                    dd($charge);
                    return redirect()->route('addmoney.paymentstripe');
                } else {
                    return redirect()->route('addmoney.paymentstripe')->with('error', 'Money not add in wallet!');
                }
            } catch (Exception $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('addmoney.paymentstripe')->with('error', $e->getMessage());
            }
        }
    }
}
