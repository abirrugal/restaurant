<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderPurchase extends Model
{
    use HasFactory;
    protected $guarded = [];

       public function order(){
        return $this->belongsTo(Purchase::class, 'purchase_id','id'); 
    }
}
