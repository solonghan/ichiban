<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'lang',
        'parent_id',
        'cover',
        'thumb',
        'category',
        'date',
        'title',
        'summary',
        'content',
        'online_date',
        'offline_date',
        'create_by',
    ];
}
