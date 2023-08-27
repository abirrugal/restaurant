<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddOnsMaterialSetting extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function add_amounts(){
        return $this->hasMany(AddOnsMaterialAmount::class,  'add_ons_mat_setting_id', 'id');
     }
}
