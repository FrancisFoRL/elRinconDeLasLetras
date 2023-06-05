<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Category
     * @var array
     */
    protected $fillable = ['name', 'last_name', 'phone', 'address', 'country', 'population', 'province', 'postal_code', 'card_info', 'user_id'];

    /**
     * Define la relación uno a uno con el modelo User.
     * @return User
     */
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
