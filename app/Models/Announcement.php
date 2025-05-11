<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{

    protected $casts = [
        'tags' => 'array',
        'images' => 'array'
    ];
    protected $fillable = [
        'images',
        'title',
        'content',
        'tags',
    ];
}
