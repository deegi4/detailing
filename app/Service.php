<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
