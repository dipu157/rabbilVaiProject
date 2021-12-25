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

    function ServiceDelete(Request $req){

    	$id = $req->input('id');
    	$result = serviceModel::where('id','=',$id)->delete();
    	if($result == true){
    		return 1;
    	}else{
    		return 0;
    	}

    }
}
