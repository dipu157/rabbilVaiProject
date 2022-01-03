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

    function getServiceDetails(Request $req){

        $id = $req->input('id');
        $result = json_encode(serviceModel::where('id','=',$id)->get());

        return $result;
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

    function ServiceUpdate(Request $req){

        $id = $req->input('id');
        $name = $req->input('service_name');
        $des = $req->input('service_des');
        $img = $req->input('service_img');


        $result = serviceModel::where('id','=',$id)->update(['service_name'=>$name, 'service_des'=>$des,'service_img'=>$img ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    function ServiceAdd(Request $req){

        $name = $req->input('service_name');
        $des = $req->input('service_des');
        $img = $req->input('service_img');


        $result = serviceModel::insert(['service_name'=>$name, 'service_des'=>$des,'service_img'=>$img ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }
}
