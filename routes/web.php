<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\SearchController;
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
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/book/{slug}', ShowBook::class)->name('book.show');
Route::get('/category/{slug}', [CategoryController::class, 'index'])->name('category.show');
Route::get('/cart/cart-show-inicio', CartShowInicio::class)->name('cartNav');
Route::get('/cart/cart-show', CartShow::class)->name('cart');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    //Aqui meter ruta para validar pedido y la lista de favoritos
    Route::get('/wishlist', Wishlist::class)->name('wishlist');
    Route::delete('/wishlist/remove/{id}', [Wishlist::class, 'removeFromWishlist'])->name('wishlist.remove');
    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('checkout');
        Route::post('/request-payment', 'RequestPayment')->name('requestpayment');
        Route::get('/payment-success', 'PaymentSuccess')->name('paymentsuccess');
        Route::get('/payment-cancel', 'PaymentCancel')->name('paymentCancel');
        Route::post('/stripe', 'PaymentStripe')->name('paymentStripe');
    });

    Route::get('/pedido-completado', function () {
        return view('checkout.pedido-completado');
    })->name('pay-success');

    Route::get('/user/pedidos', function () {
        $orders = Order::where('user_id', Auth::user()->id)->get();
        $ordersId = Order::where('user_id', Auth::user()->id)->pluck('id');
        $books = DB::table('books_orders')
            ->whereIn('order_id', $ordersId)->join('books', 'books_orders.book_id', '=', 'books.id')->select('books_orders.*', 'books.*')->get();
        return view('profile.pedidos', compact('orders', 'books'));
    })->name('pedidos');

    Route::get('/user/review', function () {
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



// Route::get('/index', ShowCart::class)->name('cart.index');

Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
