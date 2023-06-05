<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Author
 */
class Author extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Autor.
     * @var array
     */
    protected $fillable = ['name', 'bio'];

    /**
     * Define la relación de 1:N con el modelo Book.
     * @return Book
     */
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
