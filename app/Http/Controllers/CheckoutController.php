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

    /**
     * Muestra la página de pago del checkout.
     *
     * @return view  vista de la página de pago.
     */
    public function index()
    {
        //Array que contiene todas la provicias a elegir en la direccion de envio
        $provincias = array("Álava", "Albacete", "Alicante", "Almería", "Asturias", "Ávila", "Badajoz", "Barcelona", "Burgos", "Cáceres", "Cádiz", "Cantabria", "Castellón", "Ciudad Real", "Córdoba", "Cuenca", "Gerona", "Granada", "Guadalajara", "Guipúzcoa", "Huelva", "Huesca", "Islas Baleares", "Jaén", "La Coruña", "La Rioja", "Las Palmas", "León", "Lérida", "Lugo", "Madrid", "Málaga", "Murcia", "Navarra", "Orense", "Palencia", "Pontevedra", "Salamanca", "Santa Cruz de Tenerife", "Segovia", "Sevilla", "Soria", "Tarragona", "Teruel", "Toledo", "Valencia", "Valladolid", "Vizcaya", "Zamora", "Zaragoza");
        return view('checkout.pago', compact('provincias'));
    }

    /**
     * Procesa la solicitud de pago y crea una orden de pago en PayPal.
     *
     * @param Request $request solicitud HTTP que contiene los datos de la transacción.
     * @return void
     */
    public function RequestPayment(Request $request)
    {
        //Se validan los campos del formulario
        $request->validate([
            'nombre' => 'required|string|min:3|max:30',
            'apellidos' => 'required|string|min:3|max:50',
            'direccion' => 'required|string|min:10|max:100',
            'provincia' => 'required|string',
            'postal' => 'required|numeric|min:5',
        ]);

        //Si los campos estan correctamente, se guardan en un varible de sesión
        session()->put('nombre', $request->nombre);
        session()->put('apellidos', $request->apellidos);
        session()->put('direccion', $request->direccion);
        session()->put('provincia', $request->provincia);
        session()->put('postal', $request->postal);

        $provider = new PayPalClient; // Se crea una instancia del cliente de PayPal
        $provider->setApiCredentials(config('paypal')); // Se establecen las credenciales de la API de PayPal
        $paypalToken = $provider->getAccessToken(); // Se obtiene el token de acceso a PayPal
        $amount = Cart::subtotal() + 4.99; //Se guarda el total de la compra en una varible para despues convertirla a string

        //Se genera un nuevo pedido en Paypal
        $response = $provider->createOrder([
            'intent' => 'CAPTURE',
            'application_context' => [
                'return_url' => route('paymentsuccess'), //En caso de que todo salga existosamente, se redirigue al pago con PayPal.
                'cancel_url' => route('paymentCancel'), //En caso de cancelar, se volvera a la página de checkout.
                'brand_name' => 'El Rincón de las Letras',
            ],
            'purchase_units' => [
                0 => [
                    'amount' => [
                        'currency_code' => 'EUR',
                        'value' => strval($amount), //Precio total de la compra a pagar en Paypal.
                    ],
                ]
            ]
        ]);

        //Si existe el id de repuesta se procede a pasar a la pasarela de pago de Paypal
        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']); // Se redirige al enlace de aprobación de PayPal
                }
            }

            return redirect()->route('checkout')->with('error', 'Errores'); // Redirige a la página de checkout con un mensaje de error
        } else {
            return redirect()->route('checkout')->with('error', $response['message'] ?? 'Error en la cantidad de pago');  // Redirige a la página de checkout con un mensaje de error
        }
    }

    /**
     * PaymentSuccess
     *
     * Procesa el pago existoso efectuado en Paypal.
     *
     * @param  Request $request solicitud HTTP que contiene los datos de confirmación de pago.
     * @return void
     */

    public function PaymentSuccess(Request $request)
    {
        $provider = new PayPalClient; // Se crea una instancia del cliente de PayPal
        $provider->setApiCredentials(config('paypal')); // Se establece las credenciales de la API de PayPal.
        $paypalToken = $provider->getAccessToken(); // Se obtiene el token de acceso de PayPal.
        $response = $provider->capturePaymentOrder($request['token']); // Se captura el pedido con pago en PayPal utilizando el token proporcionado.

        // Si el estado del pago es COMPLETED, se procede a crear la nueva orden en la base de datos
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $order = Order::create([
                'user_id' => Auth::user()->id,
                'total_paid' => Cart::subtotal() + 4.99,
                'order_number' => mt_rand(100000, 999999),
            ]);

            $order_details = Order_details::create([
                'order_id' => $order->id,
                'customer_name' => session()->get('nombre'),
                'customer_lastname' => session()->get('apellidos'),
                'dataShipped' => session()->get('direccion'),
                'province' => session()->get('provincia'),
                'postal_code' => session()->get('postal'),
                'pay_method' => 'Paypal',
                'items_quantity' => Cart::count()
            ]);



            foreach (Cart::content()->toArray() as $key => $value) {
                $book = Book::find($value['id']); // Obtenemos el modelo del libro comprado

                //Se relaciona el libro con el pedido, almacenando el nombre del libro, la cantidad y el coste unitario.
                $order->books()->attach($book->id, ['bookName' => $value['name'], 'book_quantity' => $value['qty'], 'unitCost' => $book->price]); // Relacionamos el libro con el pedido

            }

            //Se vacia el carrito despues de la compra y se almacena si el usuario esta logueado
            Cart::destroy();
            if (Auth::user()) {
                Cart::store(auth()->user()->id);
            } else {
                Cart::store('');
            }

            // Se redirige a la ruta de pedido completado correctamente.
            return redirect()->route('pay-success');
        } else {
            // Redirige de nuevo a la página de checkout con un mensaje de error si el estado del pago no se completo.
            return redirect()->route('checkout')->with('error', $response['message'] ?? 'Error en el pago');
        }
    }

    /**
     * Maneja la cancelación del pago por parte del usuario.
     *
     * @return route vuelve a la ruta de checkout con un mensaje de error
     */

    public function PaymentCancel()
    {
        return redirect()->route('checkout')->with('error', $response['message'] ?? 'Cancelastes el pago con Paypal');
    }


    /**
     * Realiza el pago utilizando el método de Stripe.
     *
     * @param Request $request solicitud HTTP que contiene los datos del pago.
     * @return void
     */
    public function PaymentStripe(Request $request)
    {
        //Se valida que todo los datos introducido en el formulario esten correctamente
        $request->validate([
            'nombre' => ['required', 'string', 'min:3', 'max:30'],
            'apellidos' => ['required', 'string', 'min:3', 'max:50'],
            'direccion' => ['required', 'string', 'min:10', 'max:100'],
            'provincia' => ['required', 'string'],
            'postal' => ['required', 'numeric', 'min:5'],
            'nomTitular' => ['required', 'string'],
            'card_no' => ['required', 'numeric', 'digits:16'],
            'ccExpiryMonth' => ['required', 'numeric', 'min:1', 'max:12'],
            'ccExpiryYear' => ['required', 'numeric', 'digits:4'],
            'cvvNumber' => ['required', 'numeric', 'digits:3'],
        ]);

        //Se utiliza para realizar una validación adicional.
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'ccExpiryMonth' => 'required',
            'ccExpiryYear' => 'required',
            'cvvNumber' => 'required',
            // 'amount' => 'required',
        ]);

        $input = $request->except('_token'); //Se obtiene todos los datos de la solicitud excepto el campo '_token' y se asignan a la variable $input.
        $amount = Cart::subtotal() + 4.99; //Se guarda el total de la compra en una varible para despues convertirla a string

        //Si los campos estan correctamente, se guardan en un varible de sesión
        session()->put('nombre', $request->nombre);
        session()->put('apellidos', $request->apellidos);
        session()->put('direccion', $request->direccion);
        session()->put('provincia', $request->provincia);
        session()->put('postal', $request->postal);

        //Se verifica si la validación adicional del Validator ha sido existosa.
        if ($validator->passes()) {
            $stripe = Stripe::setApiKey(env('STRIPE_SECRET')); //Se establece la clave de API de Stripe, utilizando el valor almacenado en la variable de entorno 'STRIPE_SECRET'.

            try {
                //Se crea un token de tarjeta de crédito utilizando los detalles de la tarjeta proporcionados en la solicitud.
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('card_no'),
                        'exp_month' => $request->get('ccExpiryMonth'),
                        'exp_year' => $request->get('ccExpiryYear'),
                        'cvc' => $request->get('cvvNumber'),
                    ],
                ]);


                //Verifica si no se ha obtenido un ID de token. Si es así, se redirige a la ruta 'stripe.add.money'.
                if (!isset($token['id'])) {
                    return redirect()->route('stripe.add.money');
                }

                //Se crea un cargo en Stripe utilizando el ID del token de tarjeta, el precio total y la descripción proporcionada.
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'EUR',
                    'amount' => strval($amount),
                    'description' => 'Compra en la tienda del Rincón de las Letras',
                ]);

                //Se erifica si el estado del cargo es exitoso. Si es asi, se procecede a crear un nuevo pedido en la base de datos.
                if ($charge['status'] == 'succeeded') {
                    $order = Order::create([
                        'user_id' => Auth::user()->id,
                        'total_paid' => Cart::subtotal() + 4.99,
                        'order_number' => mt_rand(100000, 999999),
                    ]);

                    $order_details = Order_details::create([
                        'order_id' => $order->id,
                        'customer_name' => session()->get('nombre'),
                        'customer_lastname' => session()->get('apellidos'),
                        'dataShipped' => session()->get('direccion'),
                        'province' => session()->get('provincia'),
                        'postal_code' => session()->get('postal'),
                        'pay_method' => 'Tarjeta',
                        'items_quantity' => Cart::count()
                    ]);


                    foreach (Cart::content()->toArray() as $key => $value) {
                        $book = Book::find($value['id']); // Obtenemos el modelo del libro comprado.

                        //Se relaciona el libro con el pedido, almacenando el nombre del libro, la cantidad y el coste unitario.
                        $order->books()->attach($book->id, ['bookName' => $value['name'], 'book_quantity' => $value['qty'], 'unitCost' => $book->price]); // Relacionamos el libro con el pedido
                    }

                    //Se vacia el carrito despues de la compra y se almacena si el usuario esta logueado
                    Cart::destroy();
                    if (Auth::user()) {
                        Cart::store(auth()->user()->id);
                    } else {
                        Cart::store('');
                    }

                    // Se redirige a la ruta de pedido completado correctamente.
                    return redirect()->route('pay-success');
                } else {
                    //En caso de error se vuelve a la página de checkout
                    return redirect()->route('checkout')->with('error', '¡No hay dinero en el saldo!');
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
