<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;
use App\CoursesModel;
use App\serviceModel;
use App\visitorModel;

class HomeController extends Controller
{
	function loginIndex(){

		return view('login');
	}

    function HomeIndex(){

    	$totalProject =  ProjectModel::count();
    	$totalCourse = CoursesModel::count();
    	$totalService = serviceModel::count();
    	$totalVisitor = visitorModel::count();



        return view('Home',compact('totalProject','totalCourse','totalService','totalVisitor'));
    }
}
