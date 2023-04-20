<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Cart;

class ShoppingCartController extends Controller
{
    public function index()
    {
        return view('cart.index');
    }

}

