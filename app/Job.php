<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    //
    public function appointments()
    {
        return $this->belongsToMany(Appointment::class);
    }
}
