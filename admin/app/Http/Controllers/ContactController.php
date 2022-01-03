<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContactModel;

class ContactController extends Controller
{
    function ContactIndex(){

        return view('Contact');
    }

    function getContactData(){

    	$contactData = json_encode(ContactModel::all());

      //  dd($contactData);

  		return $contactData;
    }

    function getContactDetails(Request $req){

        $id = $req->input('id');
        $result = json_encode(ContactModel::where('id','=',$id)->get());

        return $result;
    }

    function ContactDelete(Request $req){

    	$id = $req->input('id');
    	$result = ContactModel::where('id','=',$id)->delete();
    	if($result == true){
    		return 1;
    	}else{
    		return 0;
    	}

    }
}
