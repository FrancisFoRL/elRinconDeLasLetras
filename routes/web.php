<?php


use App\Http\Livewire\Cart\CartShow;
use App\Http\Livewire\Cart\CartShowInicio;
use App\Http\Livewire\Navbar;
use App\Http\Livewire\ShowBook;
use App\Http\Livewire\ShowInicio;
use Illuminate\Support\Facades\Route;
use \App\Http\Livewire\Wishlist;
use App\Models\Book;

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
Route::get('/book', ShowBook::class)->name('book');
Route::get('/book/{slug}', function ($slug) {
    $book = Book::where('slug', $slug)->first();
    return view('livewire.show-book', compact('book'));
})->name('book.show');

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
});

Route::prefix('admin')->middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
});

// Route::get('/index', ShowCart::class)->name('cart.index');

//AIzaSyCXitozlkM6Wnsxgk7qKR96VrY04ueNt1I
Route::get('/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');
