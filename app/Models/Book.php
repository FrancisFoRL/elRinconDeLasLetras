<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'isbn', 'description', 'price', 'image', 'pages', 'editorial_id', 'author_id', 'stock'];

    public function editorial()
    {
        return $this->belongsTo(Editorial::class);
    }

    public function authors()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'books_categories', 'book_id', 'category_id');
    }

    public function orders_details(){
        return $this->belongsToMany(Order_details::class, 'books_orders_details', 'order_details_id', 'book_id');
    }

    // public function shopping_carts(){
    //     return $this->belongsToMany(ShoppingCart::class, 'books_shopping_carts', 'book_id', 'shopping_cart_id');
    // }
}
