<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;

class ProjectController extends Controller
{
    function projectIndex(){

    	$projectData = json_decode(ProjectModel::orderBy('id','desc')->get());

    	return view('projects',compact('projectData'));
    }
}
