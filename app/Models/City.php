<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Dist;

class City extends Model
{
    use HasFactory;

    public function dist(){
        return $this->hasMany(Dist::class, 'city_id');
    }
}
