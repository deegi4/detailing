<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\CarClass;
use App\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Appointments extends Controller
{
    //
    public function show()
    {
//        $carClasses = CarClass::all();
//        $serviceTypes = ServiceType::all();
//        $serviceTypes = $serviceTypes->load('jobs');
//        foreach ($serviceTypes as $serviceType) {
//            $serviceType->jobs->load('service');
//        }
//        $priceList = $this->getPriceList($carClasses, $serviceTypes);
//
//        $appointments = Appointment::all();
//        $dateList = $this->getDateList($appointments);

        return view('appointments')->with([
//            'carClasses' => $carClasses,
//            'serviceTypes' => $serviceTypes,
//            'priceList' => $priceList,
//            'dateList' => $dateList,
            ]);
    }
    public function getDateList($appointments = [])
    {
        $start_work_h = 10;
        $end_work_h = 20;
        $period_h = 1;
        $day_count = 14;
        $days = range(0, $day_count-1);
        $hours = range($start_work_h, $end_work_h - $period_h);

//        $carbon = Carbon::parse($date);
//        $carbon_h = Carbon::parse($date)->addHours($start_work_h);
//        $today = Carbon::today();
//        $todayofweek = $today->isoFormat('dddd D');
//        $todayofmonths = $today->isoFormat('D');
//        $todayofweek = $today->isoFormat('w');
//        $today_start = Carbon::today()->addHours($start_work_h);
//
//        $year = 2000; $month = 4; $day = 19;
//        $hour = 20; $minute = 30; $second = 15; $tz = 'Europe/Moscow';
//        $x1 = Carbon::createFromDate($year, $month, $day, $tz)."\n";
//        $x2 = Carbon::createMidnightDate($year, $month, $day, $tz)."\n";
//        $x3 = Carbon::createFromTime($hour, $minute, $second, $tz)."\n";
//        $x4 = Carbon::createFromTimeString("$hour:$minute:$second", $tz)."\n";
//        $x5 = Carbon::create($year, $month, $day, $hour, $minute, $second, $tz)."\n";

        $dateList = [];

        $carbon = Carbon::today('Europe/Moscow');
        $carbon->settings([
            'toStringFormat' => 'jS \o\f F, Y g:i:s a',
            ]);
        $now = $carbon->nowWithSameTz();
        $appointmentList = Appointment::all()->where('time', '>', $now);
        $disableTimes = [];
        foreach ($appointmentList as $appointment){
            $disableTimes[] = $appointment->time;
        }
        foreach ($days as $day){
            $dayData = [];
            $weekDayIndex = $carbon->isoWeekday();
            $weekDay = $carbon->isoFormat('dddd, D.MM');
            $dayData['week_number'] = $weekDayIndex;
            $dayData['day'] = $day;
            $dayData['week_day'] = $weekDay;
             $carbon->addHours($start_work_h);
            foreach ( $hours as $hour){
                $hourData = [];
                $date = $carbon->toDateTimeString();
                $dateTimestamp = $carbon->getTimestamp();
                $nowTimestamp = $now->getTimestamp();
                $isPastDate = $dateTimestamp < $nowTimestamp;
                $hourData['disable'] = $isPastDate || in_array($date, $disableTimes);
                $hourData['date'] = $date;
                $hourData['hour'] = $hour;
                $hourData['start_time'] = $carbon->isoFormat('H:mm');
                $carbon->addHours($period_h);
                $hourData['end_time'] = $carbon->isoFormat('H:mm');

                $dayData['hours'][] = $hourData;
            }
            $dateList[] = $dayData;
            $carbon->addHours(24 - $end_work_h);
        }

        return $dateList;
    }

    public function getCarClassList()
    {
         $CarClasses = CarClass::all();
        $CarClassList = $CarClasses->getDictionary();
//         $CarClassList = [];
//         foreach ($CarClasses as $CarClass) {
//             $CarClassList[$CarClass->id] = $CarClass;
//         }
         return  $CarClassList;
    }
    public function getPriceList()
    {
//        if(empty($carClasses)){
            $carClasses = CarClass::all();
//        }
//        if(empty($serviceTypes)){
            $serviceTypes = ServiceType::all();
            $serviceTypes = $serviceTypes->load('jobs');
            foreach ($serviceTypes as $serviceType) {
                $serviceType->jobs->load('service');
            }
//        }
        $priceList = [];
        foreach ($carClasses as $carClass) {
            $carClassData = [];
            $carClassId = $carClass->id;
//            $carClassData['name'] = $carClass->name;
            foreach ($serviceTypes as $serviceType) {
                $serviceTypeData = [];
                $serviceTypeData['id'] = $serviceType->id;
                $serviceTypeData['name'] = $serviceType->name;
                $jobs = $serviceType->jobs->where('car_class_id', $carClassId);
                foreach ($jobs as $job) {
                    $jobData = [];
                    $jobData['id'] = $job->id;
                    $jobData['price'] = $job->price;
                    $jobData['name'] = $job->service->name;
                    $serviceTypeData['jobs'][$job->id] = $jobData;
                }
                $carClassData['service_types'][$serviceType->id] = $serviceTypeData;
            }
            $priceList[$carClassId] = $carClassData;
        }
        return $priceList;
    }
    public function register(Request $request)
    {
        $data = $request->all();
        $date = $data['date'];
//        $carbon = Carbon::parse($date);
        $appointmentData = [
            'time' => $date,
            'client' => $data['client'],
            'contact' => $data['contact'],
            'cost' => $data['cost'],
            'payment_type' => 1,
        ];
        $appointment = new Appointment($appointmentData);
        $appointment->save();
        $jobIds = $data['checkJobIds'];
        $appointment->jobs()->sync($jobIds);

        $appointmentList = Appointment::all();
        $jobs = [];
        foreach ($appointmentList as $appointmentItem){
            $jobs[$appointmentItem->id] = $appointmentItem->jobs;
        }
        return $jobs;

    }
    public function getPrice($carClassId)
    {
//        if(empty($carClasses)){
//        $carClasses = CarClass::all();
//        }
//        if(empty($serviceTypes)){
        $serviceTypes = ServiceType::all();
        $serviceTypes = $serviceTypes->load('jobs');
        foreach ($serviceTypes as $serviceType) {
            $serviceType->jobs->load('service');
        }
//        }
//        $priceList = [];
//        foreach ($carClasses as $carClass) {
            $carClassData = [];
//            $carClassData['id'] = $carClass->id;
//            $carClassData['name'] = $carClass->name;
            foreach ($serviceTypes as $serviceType) {
                $serviceTypeData = [];
                $serviceTypeData['id'] = $serviceType->id;
                $serviceTypeData['name'] = $serviceType->name;
                $jobs = $serviceType->jobs->where('car_class_id', $carClassId);
                foreach ($jobs as $job) {
                    $jobData = [];
                    $jobData['id'] = $job->id;
                    $jobData['price'] = $job->price;
                    $jobData['name'] = $job->service->name;
                    $serviceTypeData['jobs'][] = $jobData;
                }
                $carClassData['service_types'][] = $serviceTypeData;
            }
//            $priceList[] = $carClassData;
//        }
        return $carClassData;
    }

}