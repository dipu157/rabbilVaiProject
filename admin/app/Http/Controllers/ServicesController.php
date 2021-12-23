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

    	$serviceData =  serviceModel::all();

  		return view('Services',compact('serviceData'));
    }
}
