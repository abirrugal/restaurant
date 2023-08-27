<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kitchen extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kitchen(){
        return $this->belongsTo(Kitchen::class);
    }

}
