<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Order_details
     * @var array
     */
    protected $fillable = ['user_id', 'total_paid', 'order_number'];

    /**
     * Define la relación de 1:N con el modelo User.
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define la relación muchos a muchos con el modelo Book a través de la tabla books_orders.
     * @return Book
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_orders', 'order_id', 'book_id');
    }
}
