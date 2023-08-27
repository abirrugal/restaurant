<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $guarded = [];

    public function order_products(){
        return $this->hasMany(OrderProducts::class, 'order_id','id');
    }

    public function order_add_ons(){
        return $this->hasMany(OrderAddOne::class);
    }
}
