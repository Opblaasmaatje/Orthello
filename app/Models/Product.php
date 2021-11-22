<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'on_list',
        'user_id',
        'img',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
