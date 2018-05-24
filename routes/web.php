<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome' ,['title'=>'Recent News']);
});

Route::get('/Category/{id}', function () {
    return view('welcome',['title'=>'Indesign']);
});

Route::get('/Writer/{id}', function () {
    return view('welcome',['title'=>'Alexandra Jenmi']);
});

Route::get('/PostDate/{date}', function () {
    return view('welcome',['title'=>'Update in January 20, 2017']);
});

Route::get('/Article/{id}', function () {
    return view('Article');
});

Route::get('/Register', function () {
    return view('Register');
});

Route::get('/Login', function () {
    return view('Login');
});

Route::get('/AboutUs', function () {
    return view('AboutUs');
});

Route::get('/Contact', function () {
    return view('Contact');
});

Route::get('/Term', function () {
    return view('Term');
});

Route::get('/Profile', function () {
    return view('Member/Profile');
});

Route::get('/NewPost', function () {
    return view('Member/NewPost');
});

Route::get('/MyPost', function () {
    return view('Member/MyPost');
});

Route::get('/TopUp', function () {
    return view('Member/TopUp');
});

Route::get('/Banner', function () {
    return view('Member/Banner');
});

Route::get('/Withdraw', function () {
    return view('Member/Withdraw');
});

Route::get('/ForTree', function () {
    return view('ForTree');
});
