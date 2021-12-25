<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Home');
});

Route::get('/visitor','VisitorController@VisitorIndex');

Route::get('/services','ServicesController@ServiceIndex');
Route::get('/serviceget','ServicesController@getServiceData');
Route::post('/servicedelete','ServicesController@ServiceDelete');
Route::post('/serviceDetails','ServicesController@getServiceDetails');
Route::post('/serviceUpdateClick','ServicesController@ServiceUpdate');
