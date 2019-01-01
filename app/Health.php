<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Health extends Model
{
    protected $fillable = [
        'user_id',
        'weight',
        'bmi',
        'body_fat',
        'assay_date',
    ];
}
