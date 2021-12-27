<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\visitorModel;
use App\ServicesModel;
use App\CoursesModel;
use App\ProjectModel;
use App\ContactModel;
use App\ReviewModel;

class HomeController extends Controller
{
    function HomeIndex(){

    	$UserIP=$_SERVER['REMOTE_ADDR'];
    	date_default_timezone_set("Asia/Dhaka");
  		$timeDate= date("Y-m-d h:i:sa");

  		visitorModel::insert([
  			'ip_address' => $UserIP,
  			'visit_time' => $timeDate
  		]);

      $serviceData = json_decode(ServicesModel::all());
      $courseData = json_decode(CoursesModel::orderBy('id','desc')->limit(6)->get());
      $projectData = json_decode(ProjectModel::orderBy('id','desc')->limit(6)->get());
      $reviewData = json_decode(ReviewModel::all());


  		return view('Home',compact('serviceData','courseData','projectData','reviewData'));
    }


    function contactSend(Request $req){

        $contact_name = $req->input('contact_name');
        $contact_mobile = $req->input('contact_mobile');
        $contact_email = $req->input('contact_email');
        $contact_message = $req->input('contact_message');

        $result = ContactModel::insert([
          'contact_name'=>$contact_name, 
          'contact_mobile'=>$contact_mobile,
          'contact_email'=>$contact_email,
          'contact_message'=>$contact_message
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }
}
