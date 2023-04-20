<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'quantity'];

    public function book(){
        return $this->belongsTo(Book::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function books(){
        return $this->belongsToMany(ShoppingCart::class, 'books_shopping_carts', 'shopping_cart_id', 'book_id');
    }
}
