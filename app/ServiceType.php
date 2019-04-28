<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    //
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function jobs()
    {
        return $this->hasManyThrough(Job::class, Service::class);
    }

}
