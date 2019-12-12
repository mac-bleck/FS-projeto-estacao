<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    protected $table = 'data';

    protected $fillable = [
        'value'
    ];

    public function sensors()
    {
        return $this->belongsTo(Sensors::class);
    }
}
