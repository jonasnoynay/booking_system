<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('home');
});
Route::get('/doctor/', function () {
    return view('doctor-login');
});

Route::get('/doctor/dashboard', function () {
    return view('dashboard');
});
Route::get('/doctor/clinics', function () {
    return view('clinics');
});
Route::get('/doctor/services', function () {
    return view('services');
});
Route::get('/doctor/profile', function () {
    return view('profile');
});
