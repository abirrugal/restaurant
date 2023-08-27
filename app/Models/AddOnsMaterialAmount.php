<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnsMaterialAmount extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $timestamps = false;
    
    public function add_setting(){
        return $this->belongsTo(AddOnsMaterialSetting::class, 'id','add_ons_mat_setting_id');
     }
}
