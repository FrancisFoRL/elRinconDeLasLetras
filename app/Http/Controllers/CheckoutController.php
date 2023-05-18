<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Order;
use App\Models\Order_details;
use Cartalyst\Stripe\Laravel\Facades\Stripe as Stripe;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class CheckoutController extends Controller
{

    public function index()
    {
        $provincias = array("Álava", "Albacete", "Alicante", "Almería", "Asturias", "Ávila", "Badajoz", "Barcelona", "Burgos", "Cáceres", "Cádiz", "Cantabria", "Castellón", "Ciudad Real", "Córdoba", "Cuenca", "Gerona", "Granada", "Guadalajara", "Guipúzcoa", "Huelva", "Huesca", "Islas Baleares", "Jaén", "La Coruña", "La Rioja", "Las Palmas", "León", "Lérida", "Lugo", "Madrid", "Málaga", "Murcia", "Navarra", "Orense", "Palencia", "Pontevedra", "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia", "Valladolid", "Vizcaya", "Zamora", "Zaragoza");
        return view('checkout.pago', compact('provincias'));
    }

    public function RequestPayment(Request $request)
    {
        // foreach(Cart::content()->toArray() as $key=>$value){
        //     dd($value['id']);
        // }
        $request->validate([
            'nom' => 'required|string|min:3|max:30',
            'lastname' => 'required|string|min:3|max:50',
            'address' => 'required|string|min:10|max:100',
            'provincia' => 'required|string',
            'postal' => 'required|numeric|min:5',
        ]);

        session()->put('nombre', $request->nom);
        session()->put('lastname', $request->lastname);
        session()->put('address', $request->address);
        session()->put('provincia', $request->provincia);
        session()->put('postal', $request->postal);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

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
                        // 'value' => Cart::subtotal() + 4.99,
                        'value' => Cart::subtotal() + 4.99,
                    ],
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
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total_paid' => Cart::subtotal() + 4.99,
                'order_number' => mt_rand(100000, 999999),
            ]);

            $order_details = Order_details::create([
                'order_id' => $order->id,
                'customer_name' => session()->get('nombre'),
                'customer_lastname' => session()->get('lastname'),
                'dataShipped' => session()->get('address'),
                'province' => session()->get('provincia'),
                'postal_code' => session()->get('postal'),
                'pay_method' => 'Paypal',
                'items_quantity' => Cart::count()
            ]);



            foreach (Cart::content()->toArray() as $key => $value) {
                $book = Book::find($value['id']); // Obtenemos el modelo del libro

                // dd(Cart::content()->toArray(), $order, Book::find($value['id']), $book->orders_details()->attach($order_details->order_id, ['bookName' => $value['name'], 'book_quantity' => $value['qty'], 'unitCost' => $book->price]));

                $order->books()->attach($book->id, ['bookName' => $value['name'], 'book_quantity' => $value['qty'], 'unitCost' => $book->price]); // Relacionamos el libro con el pedido
            }

            Cart::destroy();
            if (Auth::user()) {
                Cart::store(auth()->user()->id);
            } else {
                Cart::store('');
            }

            return redirect()->route('pay-success');
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

        $request->validate([
            'nom' => 'required|string|min:3|max:30',
            'lastname' => 'required|string|min:3|max:50',
            'address' => 'required|string|min:10|max:100',
            'provincia' => 'required|string',
            'postal' => 'required|numeric|min:5',
            'nomTitular' => 'required|string',
            'card_no' => 'required|numeric|digits:16',
            'ccExpiryMonth' => 'nullable|numeric|min:1|max:12',
            'ccExpiryYear' => 'required|numeric|digits:2',
            'cvvNumber' => 'required|numeric|digits:3',
        ]);

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
                    'amount' => Cart::subtotal() + 4.99,
                    'description' => 'Compra en la tienda del Rincón de las Letras',
                ]);

                if ($charge['status'] == 'succeeded') {
                    return redirect()->route('pay-success');
                } else {
                    return redirect()->route('checkout')->with('error', 'Money not add in wallet!');
                }
            } catch (Exception $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            } catch (\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('checkout')->with('error', $e->getMessage());
            }
        }
    }
}
