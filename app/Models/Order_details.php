<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'customer_name', 'customer_lastname', 'dataShipped', 'province', 'postal_code', 'pay_method','items_quantity'];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function books(){
        return $this->belongsToMany(Book::class, 'books_orders_details', 'book_id', 'order_details_id');
    }
}
