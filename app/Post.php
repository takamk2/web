<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest()
 */
class Post extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];
}


