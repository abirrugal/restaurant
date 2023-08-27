<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductMatSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function amounts(){
       return $this->hasMany(ProductMatAmount::class,  'product_mat_setting_id', 'id');
    }
}
