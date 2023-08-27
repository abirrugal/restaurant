<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];

        public function order_products(){
        return $this->hasMany(OrderPurchase::class, 'purchase_id','id');
    }

}
