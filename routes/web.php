<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ShowContacto;
use App\Http\Livewire\AddOpinion;
use App\Http\Livewire\Cart\CartShow;
use App\Http\Livewire\Cart\CartShowInicio;
use App\Http\Livewire\Navbar;
use App\Http\Livewire\ShowBook;
use App\Http\Livewire\ShowInicio;
use Illuminate\Support\Facades\Route;
use \App\Http\Livewire\Wishlist;
use App\Models\Book;
use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', ShowInicio::class)->name('inicio');
Route::get('/navbar', Navbar::class)->name('nav');
Route::get('/busqueda', [SearchController::class, 'search'])->name('search');
Route::get('/libros/{slug}', ShowBook::class)->name('book.show');
Route::get('/categorias/{slug}', [CategoryController::class, 'index'])->name('category.show');
Route::get('/cart/cart-show-inicio', CartShowInicio::class)->name('cartNav');
Route::get('/carrito', CartShow::class)->name('cart');
Route::get('/sobre-nosotros', function () {
    return view('sobrenost');
})->name('sobrenost');
Route::get('/contacto', [ShowContacto::class, 'index'])->name('contacto.show');
Route::post('/contacto', [ShowContacto::class, 'send'])->name('contacto.send');
Route::get('/información-legal', function () {
    return view('legal');
})->name('info-legal');
Route::get('/politica-de-privacidad', function () {
    return view('privacidad');
})->name('privacidad');
Route::get('mapa-web', function () {
    return view('mapa');
})->name('mapa');

Route::middleware(['auth'])->group(function () {
    //Aqui meter ruta para validar pedido y la lista de favoritos
    Route::get('/lista-de-deseos', Wishlist::class)->name('wishlist');
    Route::delete('/wishlist/remove/{id}', [Wishlist::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('checkout');
        Route::post('/request-payment', 'RequestPayment')->name('requestpayment');
        Route::get('/payment-success', 'PaymentSuccess')->name('paymentsuccess');
        Route::get('/payment-cancel', 'PaymentCancel')->name('paymentCancel');
        Route::post('/stripe', 'PaymentStripe')->name('paymentStripe');
        Route::post('/add-opinion', [ShowBook::class, 'addOpinion'])->name('addOpinion');
        Route::get('/remove-opinion/{id}', [ShowBook::class, 'deleteOpinion'])->name('deleteOpinion');
});

    Route::get('/pedido-completado', function () {
        return view('checkout.pedido-completado');
    })->name('pay-success');

    Route::get('/perfil/pedidos', function () {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $ordersId = Order::where('user_id', Auth::user()->id)->pluck('id');
        $books = DB::table('books_orders')
            ->whereIn('order_id', $ordersId)->join('books', 'books_orders.book_id', '=', 'books.id')->select('books_orders.*', 'books.*')->get();
        return view('profile.pedidos', compact('orders', 'books'));
    })->name('pedidos');

    Route::get('/perfil/reseñas', function () {
        $reviews = Review::where('user_id', Auth::user()->id)
            ->join('books', 'reviews.book_id', '=', 'books.id')
            ->select('reviews.*', 'books.title as book_title')
            ->get();

        return view('profile.review', compact('reviews'));
    })->name('opiniones');
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
});

Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
