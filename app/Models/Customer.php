<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'last_name', 'phone', 'address', 'country', 'population', 'province', 'postal_code', 'card_info', 'user_id'];

    public function user(){
        return $this->hasOne(User::class);
    }
}
