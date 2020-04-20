<?php

use Illuminate\Http\Request;

Route::namespace('API')->group(function () {
  Route::post('register', 'Auth\UserController@register');
  Route::post('login', 'Auth\UserController@login');
  Route::post('loginfb', 'Auth\UserController@loginfb');
  Route::post('logingg', 'Auth\UserController@logingg');
  Route::get('getTinTucNew', 'TinTucController@getTinTucNew');
  Route::get('getTinTucCate', 'TinTucController@getTinTucCate');
  Route::get('getDanhMucTinTuc', 'TinTucController@getDanhMucTinTuc');
  Route::get('getDetailTinTuc/{id}', 'TinTucController@getDetailTinTuc');
  Route::get('getNationHome', 'HomeController@getNationHome');
  Route::get('getCategoriesJobHome', 'HomeController@getCategoriesJobHome');
  Route::get('getTinTuyenSinhHome', 'HomeController@getTinTuyenSinhHome');
  Route::post('saveEmail', 'HomeController@saveEmail');
  //tin tuyen dung
  Route::get('getTinTuyenDungNew', 'TinTuyenDungController@getTinTuyenDungNew');
});
Route::group(['middleware' => 'jwt.auth'], function () {
  Route::namespace('API')->group(function () {
    //auth
      Route::get('user', 'Auth\UserController@user');
      Route::post('changePassword', 'Auth\UserController@changePassword');
      Route::post('changeInfo', 'Auth\UserController@changeInfo');
      Route::get('getInfoCompany', 'Auth\UserController@getInfoCompany');
      Route::post('changeInfoCompany', 'Auth\UserController@changeInfoCompany');
      Route::get('logout', 'Auth\UserController@logout');
    //admin
      Route::prefix('tintuc')->group(function () {
        Route::get('getTinTuc', 'Admin\TinTucController@getTinTuc');
        Route::post('changeStatusTinTuc', 'Admin\TinTucController@changeStatusTinTuc');
        Route::post('deleteTinTuc', 'Admin\TinTucController@deleteTinTuc');
        Route::post('createTinTuc', 'Admin\TinTucController@createTinTuc');
        Route::post('updateTinTuc', 'Admin\TinTucController@updateTinTuc');
      });
  });
});

