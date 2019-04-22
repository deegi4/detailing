<?php

namespace App\Http\Controllers;

use App\CarClass;
use Illuminate\Http\Request;

class Appointments extends Controller
{
    //
    public function show()
    {
        $carClasses = CarClass::all();
        dd($carClasses);
        return view('main_page');
    }
}
