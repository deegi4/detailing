<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    //
    protected $guarded = [];

    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
