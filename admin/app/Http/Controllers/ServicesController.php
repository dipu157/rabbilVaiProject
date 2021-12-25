<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\serviceModel;

class ServicesController extends Controller
{
    function ServiceIndex(){ 

  		return view('Services');
    }

    function getServiceData(){

    	$serviceData = json_encode(serviceModel::all());

  		return $serviceData;
    }
}
