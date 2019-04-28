<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarClass extends Model
{
    //
    public function jobs()
    {
        return $this->HasMany(Job::class);
    }

    public function services()
    {
        return $this->hasManyThrough(Service::class, Job::class );
    }
}
