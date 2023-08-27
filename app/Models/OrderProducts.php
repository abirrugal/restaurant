<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProducts extends Model
{
    use HasFactory;
    protected $guarded = [];
    public $timestamps = false;
    
    public function order(){
        return $this->belongsTo(Order::class, 'order_id','id'); 
    }
}
