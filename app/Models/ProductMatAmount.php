<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMatAmount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;

    public function setting(){
       return $this->belongsTo(ProductMatSetting::class, 'id','product_mat_setting_id');
    }
}
