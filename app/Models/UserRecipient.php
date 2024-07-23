<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRecipient extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'user_id',
        'username',
        'city',
        'dist',
        'address',
        'phone',
        'ext',
        'email',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
