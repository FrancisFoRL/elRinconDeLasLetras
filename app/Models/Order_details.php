<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;

    /**
     * Los atributos que se le asignan al modelo de Order_details
     * @var array
     */
    protected $fillable = ['order_id', 'customer_name', 'customer_lastname', 'dataShipped', 'province', 'postal_code', 'pay_method','items_quantity'];

    /**
     * Define la relación de 1:N con el modelo Order.
     * @return Order
     */
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
