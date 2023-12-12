<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    use HasFactory;

    const TYPE_CATEGORY = 'category';
    const TYPE_AUTHOR = 'author';
    const TYPE_SOURCE = 'source';

    protected $fillable=['user_id','type','preference'];
}
