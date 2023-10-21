<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertise extends Model
{
    protected $fillable = ['title', 'slug', 'price', 'expires_at', 'description', 'user_id', 'category_id'];

    use HasFactory;
}
