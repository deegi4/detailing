<?php

namespace App\Http\Controllers;

use App\CarClass;
use App\ServiceType;
use Illuminate\Http\Request;

class Appointments extends Controller
{
    //
    public function show()
    {
        $carClasses = CarClass::all();
        $serviceTypes = ServiceType::all();
        $serviceTypes = $serviceTypes->load('jobs');
        foreach ($serviceTypes as $serviceType) {
            $serviceType->jobs->load('service');
        }
        $priceList = $this->getPriceList($carClasses, $serviceTypes);

        return view('appointments')->with([
            'carClasses' => $carClasses,
            'serviceTypes' => $serviceTypes,
            'priceList' => $priceList,
            ]);
    }

    public function getPriceList($carClasses, $serviceTypes)
    {
        $priceList = [];
        foreach ($carClasses as $carClass) {
            $carClassData = [];
            $carClassData['id'] = $carClass->id;
            $carClassData['name'] = $carClass->name;
            foreach ($serviceTypes as $serviceType) {
                $serviceTypeData = [];
                $serviceTypeData['id'] = $serviceType->id;
                $serviceTypeData['name'] = $serviceType->name;
                $jobs = $serviceType->jobs->where('car_class_id', $carClass->id);
                foreach ($jobs as $job) {
                    $jobData = [];
                    $jobData['id'] = $job->id;
                    $jobData['price'] = $job->price;
                    $jobData['name'] = $job->service->name;
                    $serviceTypeData['jobs'][] = $jobData;
                }
                $carClassData['service_types'][] = $serviceTypeData;
            }
            $priceList[] = $carClassData;
        }
        return $priceList;
    }
}
