<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhotoModel;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    function PhotoIndex(){

    	return view('Gallery');
    }

    function PhotoJSON(){

    	return PhotoModel::take(4)->get();
    }

    function PhotoJSONById(Request $request){

        $firstId = $request->id;
        $lastId = $firstId+4;

    	return PhotoModel::where('id','>',$firstId)->where('id','<=',$lastId)->get();
    }

    function photoUpload(Request $request){

       $photoPath = $request->file('photo')->store('public');

       $photoName = (explode('/',$photoPath))[1];
       $host = $_SERVER['HTTP_HOST'];
       $location = "http://localhost/rabbilVaiProject/admin/storage/app/public/".$photoName;

       $result = PhotoModel::insert(['location'=>$location]);
       return $result;
    }

    function photoDelete(Request $request){

        $oldPhotoUrl = $request->input('oldPhotoUrl');
        $oldPhotoId = $request->input('id');

        $oldPhotoUrlArray = explode("/",$oldPhotoUrl);
        $oldPhotoName = end($oldPhotoUrlArray);
        $deletePhotoFile = Storage::delete('public/'.$oldPhotoName);

        $deleteRow = PhotoModel::where('id','=',$oldPhotoId)->delete();
        return $deleteRow;
    }
}
