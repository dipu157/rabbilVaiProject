<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ReviewModel;

class ReviewController extends Controller
{
    function ReviewIndex(){

        return view('review');
    }

    function getReviewData(){

    	$reviewData = json_encode(ReviewModel::all());

  		return $reviewData;
    }

    function getReviewDetails(Request $req){

        $id = $req->input('id');
        $result = json_encode(ReviewModel::where('id','=',$id)->get());

        return $result;
    }

    function ReviewDelete(Request $req){

    	$id = $req->input('id');
    	$result = ReviewModel::where('id','=',$id)->delete();
    	if($result == true){
    		return 1;
    	}else{
    		return 0;
    	}

    }

    function ReviewUpdate(Request $req){

        $id = $req->input('id');
        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');


        $result = ReviewModel::where('id','=',$id)->update(['name'=>$name, 'des'=>$des,'img'=>$img ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }

    function ReviewAdd(Request $req){

        $name = $req->input('name');
        $des = $req->input('des');
        $img = $req->input('img');


        $result = ReviewModel::insert(['name'=>$name, 'des'=>$des,'img'=>$img ]);
        if($result == true){
            return 1;
        }else{
            return 0;
        }

    }
}
