<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sensors extends Model
{
    protected $table = 'sensors';

    protected $fillable = [
        'type',	
        'partnumber',
        'description'
    ];

    public function station()
    {
        return $this->belongsTo(Stations::class);
    }

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
