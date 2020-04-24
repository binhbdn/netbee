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
  Route::post('saveEmail', 'HomeController@saveEmail');
  //tin tuyen dung
  Route::get('getTinTuyenDungNew', 'TinTuyenDungController@getTinTuyenDungNew');
  Route::get('getTinTuyenDungForCompany/{id}', 'TinTuyenDungController@getTinTuyenDungForCompany');
  Route::get('getTinTuyenDungHot', 'TinTuyenDungController@getTinTuyenDungHot');
  Route::get('getDetailTinTuyenDung/{id}', 'TinTuyenDungController@getDetailTinTuyenDung');
  Route::get('getInfoCompanyById/{id}', 'Auth\UserController@getInfoCompanyById');
  //tìm kiếm
  Route::get('searchCompany', 'TimKiemController@searchCompany');
});
Route::group(['middleware' => 'jwt.auth'], function () {
  Route::namespace('API')->group(function () {
    //auth
      Route::get('user', 'Auth\UserController@user');
      Route::post('changePassword', 'Auth\UserController@changePassword');
      Route::post('changeInfo', 'Auth\UserController@changeInfo');
      Route::get('getInfoCompany', 'Auth\UserController@getInfoCompany');
      Route::post('changeInfoCompany', 'Auth\UserController@changeInfoCompany');
      Route::get('getCompanyHot', 'Auth\UserController@getCompanyHot');
      Route::get('getCompanyNew', 'Auth\UserController@getCompanyNew');
      Route::get('logout', 'Auth\UserController@logout');
    //admin
      Route::prefix('tintuc')->group(function () {
        Route::get('getTinTuc', 'Admin\TinTucController@getTinTuc');
        Route::post('changeStatusTinTuc', 'Admin\TinTucController@changeStatusTinTuc');
        Route::post('changeAllStatusTinTuc', 'Admin\TinTucController@changeAllStatusTinTuc');
        Route::post('deleteTinTuc', 'Admin\TinTucController@deleteTinTuc');
        Route::post('createTinTuc', 'Admin\TinTucController@createTinTuc');
        Route::post('updateTinTuc', 'Admin\TinTucController@updateTinTuc');
        Route::get('searchTinTuc', 'Admin\TinTucController@searchTinTuc');
      });
      Route::prefix('tintuyendung')->group(function () {
        Route::get('getTinTuyenDung', 'Admin\TinTuyenController@getTinTuyenDung');
        Route::post('changeStatusTinTuyenDung', 'Admin\TinTuyenController@changeStatusTinTuyenDung');
        Route::post('changeAllStatusTinTuyenDung', 'Admin\TinTuyenController@changeAllStatusTinTuyenDung');
        Route::post('deleteTinTuyenDung', 'Admin\TinTuyenController@deleteTinTuyenDung');
        Route::get('searchTinTuyenDung', 'Admin\TinTuyenController@searchTinTuyenDung');
        Route::get('getQuocGia', 'Admin\TinTuyenController@getQuocGia');
        Route::get('getVisa', 'Admin\TinTuyenController@getVisa');
        Route::post('createTinTuyen', 'Admin\TinTuyenController@createTinTuyen');
        Route::post('postView', 'Admin\TinTuyenController@postView');
        Route::post('postSave', 'Admin\TinTuyenController@postSave');
        Route::get('getSave', 'Admin\TinTuyenController@getSave');
        Route::get('getDetailTinTuyen/{id}','Admin\TinTuyenController@getDetailTinTuyen');
        Route::post('report', 'Admin\TinTuyenController@report');
        Route::post('updateTinTuyen', 'Admin\TinTuyenController@updateTinTuyen');
      });
  });
});

