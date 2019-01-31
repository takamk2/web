<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationCheckIn extends Model
{
    protected $table = 'location_check_ins';

    protected $fillable = [
        'location_id',
        'rate',
        'date',
        'memo'
    ];

    public function getAttrName() {
        return $this->table . "_list";
    }
}
