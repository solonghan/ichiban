<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CooperativeStore extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'sort',
        'name',
        'logo',
        'summary',
        'content',
        'email',
        'phone',
        'website',
        'address',
        'fb',
        'line',
        'ig',
        'status',
    ];
}
