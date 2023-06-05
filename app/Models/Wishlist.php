<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Wishlist
     * @var array
     */
    protected $fillable = ['user_id', 'book_id'];

    /**
     * Define la relación de 1:N con el modelo User.
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Define la relación de 1:N con el modelo Book.
     * @return Book
     */
    public function book()
    {
        return $this->belongsTo(Book::class);
    }
}
