<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@loginIndex');
Route::post('/login', 'LoginController@onLogin');
Route::get('/logout', 'LoginController@onLogOut');

Route::get('/dashboard', 'HomeController@HomeIndex')->middleware('loginCheck');

Route::get('/visitor','VisitorController@VisitorIndex');


// Service Route
Route::get('/services','ServicesController@ServiceIndex')->middleware('loginCheck');;
Route::get('/serviceget','ServicesController@getServiceData')->middleware('loginCheck');;
Route::post('/servicedelete','ServicesController@ServiceDelete');
Route::post('/serviceDetails','ServicesController@getServiceDetails');
Route::post('/serviceUpdateClick','ServicesController@ServiceUpdate');
Route::post('/serviceAdd','ServicesController@ServiceAdd');

// Course Route
Route::get('/courses','CoursesController@CoursesIndex')->middleware('loginCheck');;
Route::get('/courseget','CoursesController@getCourseData')->middleware('loginCheck');;
Route::post('/coursedelete','CoursesController@CourseDelete');
Route::post('/courseDetails','CoursesController@getCourseDetails');
Route::post('/courseUpdateClick','CoursesController@CourseUpdate');
Route::post('/courseAdd','CoursesController@CourseAdd');


// Project Route
Route::get('/projects','ProjectController@ProjectIndex')->middleware('loginCheck');;
Route::get('/projectget','ProjectController@getProjectData')->middleware('loginCheck');;
Route::post('/projectsdelete','ProjectController@ProjectDelete');
Route::post('/projectsDetails','ProjectController@getProjectDetails');
Route::post('/projectsUpdateClick','ProjectController@ProjectUpdate');
Route::post('/projectsAdd','ProjectController@ProjectAdd');

// Contact Route
Route::get('/contact','ContactController@ContactIndex')->middleware('loginCheck');;
// Route::get('/projectget','ProjectController@getProjectData')->middleware('loginCheck');;
// Route::post('/projectsdelete','ProjectController@ProjectDelete');
// Route::post('/projectsDetails','ProjectController@getProjectDetails');
// Route::post('/projectsUpdateClick','ProjectController@ProjectUpdate');
// Route::post('/projectsAdd','ProjectController@ProjectAdd');

// Review Route
Route::get('/review','ReviewController@ReviewIndex')->middleware('loginCheck');;
Route::get('/reviewget','ReviewController@getReviewData')->middleware('loginCheck');;
// Route::post('/reviewdelete','ReviewController@ReviewDelete');
// Route::post('/reviewsDetails','ReviewController@getReviewDetails');
// Route::post('/reviewsUpdateClick','ReviewController@ReviewUpdate');
// Route::post('/reviewsAdd','ReviewController@ReviewAdd');

// Photo Route
Route::get('/photo','PhotoController@PhotoIndex')->middleware('loginCheck');
Route::post('/photoUp','PhotoController@photoUpload');
Route::get('/photoLoad','PhotoController@PhotoJSON');
Route::get('/photoLoadByid/{id}','PhotoController@PhotoJSONById');
Route::post('/photoDelete','PhotoController@photoDelete');
