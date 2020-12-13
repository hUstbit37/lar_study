<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::view('/{any}', 'VueVideo/index')
    ->where('any', '.*');


Route::get('/', function () {
    return view('welcome');
});

Route::get('home1', 'MyController@index');
Route::get('login1', function () {
    return view('Blade_templates/login');
});
// -------------------------------------------

Route::get('test', function () {
    return view('testvideo');
});



// ---------------------------------------------

// Route::post('test', 'MyController@upload');
// Route::get('listvideo', 'MyController@listvideo')->name('listvideo');
// Route::get('testwatch/{id}', 'MyController@testwatch')->name('testwatch');
// Route::post('comment/{id}', 'MyController@comment')->name('comment');
// -----------------------------------------------------------------
Route::get('/test.vue', function () {
    return view('VueVideo/TestVue');
});
//--------------------------------------------------------------
Route::get('/home.vue', 'VueController@home')->name('home.vue');
Route::get('show.video', 'VueController@listVideo');
Route::post('add.comment/{id}', 'VueController@addCmt');
Route::post('cmtPaganation/{id}', 'VueController@commentPaganationVue');

// --------------------------------------------------------------
Route::get('/home', 'HomeController@index')->name('home');
Route::get('view.upload', 'MyController@view_upload')->name('view.upload');
Route::post('upload.video', 'MyController@upload')->name('upload');
Route::get('watchvideo/{id}', 'MyController@watch')->name('watch');
Route::post('comment/{id}', 'CommentController@post_comment')->name('postcomment');
Route::get('listvideo', 'MyController@listvideo');

Route::get('commentPagination/{id}', 'MyController@commentPagination')->name('pagination');

//--------------------------------------------
Route::get('/ajax', 'MyController@ajaxView');
Route::get('/ajax2', 'MyController@ajaxPagination')->name('ajax-pagination');
Route::post('add', 'MyController@add')->name('add');
