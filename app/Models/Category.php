<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Category.
     * @var array
     */
    protected $fillable = ['name', 'description'];

    /**
     * Define la relación muchos a muchos con el modelo Book a través de la tabla books_categories.
     * @return Book
     */
    public function books()
    {
        return $this->belongsToMany(Book::class, 'books_categories', 'category_id', 'book_id');
    }
}
