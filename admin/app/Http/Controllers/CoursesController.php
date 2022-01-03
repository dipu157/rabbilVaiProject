<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoursesModel;

class CoursesController extends Controller
{
    function CoursesIndex(){

    	return view('Courses');
    }

    function getCourseData(){

    	$courseData = json_encode(CoursesModel::all());

  		return $courseData;
    }

    function getCourseDetails(Request $req){

        $id = $req->input('id');
        $result = json_encode(CoursesModel::where('id','=',$id)->get());

        return $result;
    }

    function CourseDelete(Request $req){

    	$id = $req->input('id');
    	$result = CoursesModel::where('id','=',$id)->delete();
    	if($result == true){
    		return 1;
    	}else{
    		return 0;
    	}

    }

    function CourseUpdate(Request $req){

        $id = $req->input('id');
        $course_name = $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee = $req->input('course_fee');
        $course_totalenroll = $req->input('course_totalenroll');
        $course_totalclass = $req->input('course_totalclass');
        $course_link = $req->input('course_link');
        $course_img = $req->input('course_img');


        $result = CoursesModel::where('id','=',$id)->update([
        	'course_name'=>$course_name, 
        	'course_des'=>$course_des,
        	'course_fee'=>$course_fee,
        	'course_totalenroll'=>$course_totalenroll,
        	'course_totalclass'=>$course_totalclass,
        	'course_link'=>$course_link,
        	'course_img'=>$course_img 
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    function CourseAdd(Request $req){

        $course_name = $req->input('course_name');
        $course_des = $req->input('course_des');
        $course_fee = $req->input('course_fee');
        $course_totalenroll = $req->input('course_totalenroll');
        $course_totalclass = $req->input('course_totalclass');
        $course_link = $req->input('course_link');
        $course_img = $req->input('course_img');


        $result = CoursesModel::insert([
        	'course_name'=>$course_name, 
        	'course_des'=>$course_des,
        	'course_fee'=>$course_fee,
        	'course_totalenroll'=>$course_totalenroll,
        	'course_totalclass'=>$course_totalclass,
        	'course_link'=>$course_link,
        	'course_img'=>$course_img
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }
}
