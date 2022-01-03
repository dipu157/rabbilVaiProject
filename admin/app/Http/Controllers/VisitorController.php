<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visitorModel;

class VisitorController extends Controller
{
    function VisitorIndex(){

    	$visitorData =  json_decode(visitorModel::orderBy('id','desc')->take(3)->get());

  		return view('visitor',compact('visitorData'));
    }
}
