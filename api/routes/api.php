<?php

use Illuminate\Http\Request;

Route::namespace('API')->group(function () {
  Route::post('register', 'Auth\UserController@create_hr');
  Route::post('login', 'Auth\UserController@login');
  Route::post('loginfb', 'Auth\UserController@loginfb');
  Route::post('logingg', 'Auth\UserController@logingg');
  Route::get('getTinTucHome', 'HomeController@getTinTucHome');
  Route::get('getNationHome', 'HomeController@getNationHome');
  Route::get('getCategoriesJobHome', 'HomeController@getCategoriesJobHome');
  Route::get('getTinTuyenSinhHome', 'HomeController@getTinTuyenSinhHome');
});
Route::group(['middleware' => 'jwt.auth'], function () {
  Route::namespace('API')->group(function () {

  });
});

