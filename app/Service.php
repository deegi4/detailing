<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function service_type()
    {
        return $this->belongsToMany(ServiceType::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
