<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


/**
 * Book
 */
class Book extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Autor.
     * @var array
     */
    protected $fillable = ['title', 'isbn', 'description', 'price', 'image', 'pages', 'editorial_id', 'author_id', 'stock'];

    /**
     * Define la relación de 1:N con el modelo Editorial.
     * @param  array $datos contiene todos los datos para enviar en el email.
     * @return Editoral
     */
    public function editorial()
    {
        return $this->belongsTo(Editorial::class);
    }

    /**
     * Define la relación de 1:N con el modelo Autor.
     * @return Author
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Define la relación de 1:N con el modelo Reviews.
     * @return Reviews
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Define la relación N:M con el modelo Category a través de la tabla 'books_categories'.
     * @return Category
     */
    public function category()
    {
        return $this->belongsToMany(Category::class, 'books_categories', 'book_id', 'category_id');
    }

    /**
     * Define la relación N:M con el modelo Order a través de la tabla 'books_orders'.
     * @return Order
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'books_orders', 'book_id', 'order_id');
    }

    /**
     * Retorna el slug del título del modelo Book.
     * @return string
     */
    public function getSlugAttribute()
    {
        return Str::slug($this->title);
    }
}
