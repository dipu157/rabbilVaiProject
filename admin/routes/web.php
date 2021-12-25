<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home');
});

Route::get('/visitor','VisitorController@VisitorIndex');

Route::get('/services','ServicesController@ServiceIndex');
Route::get('/serviceget','ServicesController@getServiceData');
