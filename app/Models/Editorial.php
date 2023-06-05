<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Editorial extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Editorial
     * @var array
     */
    protected $fillable = ['name', 'description', 'website', 'email', 'phone', 'address'];

    /**
     * Define la relación de 1:N con el modelo Book.
     * @return Book
     */
    public function books(){
        return $this->hasMany(Book::class);
    }
}
