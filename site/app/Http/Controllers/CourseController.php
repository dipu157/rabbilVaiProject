<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CoursesModel;

class CourseController extends Controller
{
    function courseIndex(){

    	$courseData = json_decode(CoursesModel::orderBy('id','desc')->get());

    	return view('Courses',compact('courseData'));
    }
}
