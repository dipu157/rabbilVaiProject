<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProjectModel;

class ProjectController extends Controller
{
    function ProjectIndex(){

    	return view('project');
    }

    function getProjectData(){

    	$projectData = json_encode(ProjectModel::all());

  		return $projectData;
    }

    function getProjectDetails(Request $req){

        $id = $req->input('id');
        $result = json_encode(ProjectModel::where('id','=',$id)->get());

        return $result;
    }

    function ProjectDelete(Request $req){

    	$id = $req->input('id');
    	$result = ProjectModel::where('id','=',$id)->delete();
    	if($result == true){
    		return 1;
    	}else{
    		return 0;
    	}

    }

    function ProjectUpdate(Request $req){

        $id = $req->input('id');
        $project_name = $req->input('project_name');
        $project_des = $req->input('project_des');
        $project_link = $req->input('project_link');
        $project_img = $req->input('project_img');


        $result = ProjectModel::where('id','=',$id)->update([
        	'project_name'=>$project_name, 
        	'project_des'=>$project_des,
        	'project_link'=>$project_link,
        	'project_img'=>$project_img 
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    function ProjectAdd(Request $req){

        $project_name = $req->input('project_name');
        $project_des = $req->input('project_des');
        $project_link = $req->input('project_link');
        $project_img = $req->input('project_img');


        $result = ProjectModel::insert([
        	'project_name'=>$project_name, 
        	'project_des'=>$project_des,
        	'project_link'=>$project_link,
        	'project_img'=>$project_img
        ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }
}
