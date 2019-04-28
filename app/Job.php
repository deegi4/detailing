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

    public function carClass()
    {
        return $this->belongsTo(CarClass::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class );
    }

    public function scopeCarClass($query, $carClassId)
    {
        return $query->where('car_class_id', $carClassId);
    }

}
