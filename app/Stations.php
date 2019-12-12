<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stations extends Model
{
    protected $table = 'stations';

    protected $fillable = [
        'name',	
        'locality'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sensors()
    {
        return $this->hasMany(Sensors::class);
    }
}
