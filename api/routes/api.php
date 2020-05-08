<?php

use Illuminate\Http\Request;

Route::namespace('API')->group(function () {
  Route::post('register', 'Auth\UserController@register');
  Route::post('login', 'Auth\UserController@login');
  Route::post('loginfb', 'Auth\UserController@loginWithFacebook');
  Route::post('logingg', 'Auth\UserController@loginWithGoogle');
  Route::get('getTinTucNewLoading', 'TinTucController@getTinTucNewLoading');

  Route::get('getTinTucNew', 'TinTucController@getTinTucNew');
  Route::get('getTinTucSiteMap', 'TinTucController@getTinTucNew');
  Route::get('getTinTucCate', 'TinTucController@getTinTucNew');

  Route::get('getDetailTinTuc/{id}', 'TinTucController@getDetailTinTuc');
  Route::get('getNationHome', 'HomeController@getNationHome');
  Route::get('getCategoriesJobHome', 'HomeController@getCategoriesJobHome');
  Route::post('saveEmail', 'HomeController@saveEmail');
  //Company
  Route::get('getInfoAll','Customer\CompanyController@getInfoAll');
  //tin tuyen dung
  Route::get('getTinTuyenDungNew', 'TinTuyenDungController@getTinTuyenDungNew');
  Route::get('getTinTuyenDungNewCarousel', 'TinTuyenDungController@getTinTuyenDungNewCarousel');
  Route::get('getTinTuyenDungForCompany/{id}', 'TinTuyenDungController@getTinTuyenDungForCompany');
  Route::get('getTinTuyenDungHot', 'TinTuyenDungController@getTinTuyenDungHot');
  Route::get('getTinTuyenDungHotCarousel', 'TinTuyenDungController@getTinTuyenDungHotCarousel');
  Route::get('getDetailTinTuyenDung/{id}', 'TinTuyenDungController@getDetailTinTuyenDung');
  Route::get('getInfoCompanyById/{id}', 'Auth\UserController@getInfoCompanyById');
  Route::get('getCompanyHot', 'Auth\UserController@getCompanyHot');
  Route::get('getCompanyNew', 'Auth\UserController@getCompanyNew');
  Route::post('pricing_momo_bank_checking', 'MomoController@pricing_momo_bank_checking');
  Route::get('checkDiscountCode', 'MomoController@checkDiscountCode');
  //tìm kiếm
  Route::get('searchCompany', 'TimKiemController@searchCompany');
  Route::get('searchJobs', 'TimKiemController@searchJobs');
  Route::get('getQuocGia', 'TimKiemController@getQuocGia');
  Route::get('getVisa', 'TimKiemController@getVisa');
  Route::get('getAnalytic', 'Admin\DashboardController@getAnalytic');
});
Route::group(['middleware' => 'jwt.auth'], function () {
  Route::namespace('API')->group(function () {
    //auth
      Route::get('user', 'Auth\UserController@user');
      Route::post('changePassword', 'Auth\UserController@changePassword');
      Route::post('changeInfo', 'Auth\UserController@changeInfo');
      Route::get('getInfoCompany', 'Auth\CompanyController@getInfoCompany');
      Route::post('changeInfoCompany', 'Auth\CompanyController@changeInfoCompany');
      Route::get('getNotification', 'NotificationController@getNotification');
      Route::post('readNotification', 'NotificationController@readNotification');
      Route::post('readNotificationAll', 'NotificationController@readNotificationAll');
      Route::get('logout', 'Auth\UserController@logout');
      Route::post('pricing_momo_bank', 'MomoController@pricing_momo_bank');
      Route::post('pricing_momo', 'MomoController@pricing_momo');
      //apply job
      Route::post('userApplyJob', 'UngTuyenController@userApplyJob');

    //admin
      Route::prefix('tintuc')->group(function () {
        Route::get('getTinTuc', 'Admin\TinTucController@getTinTuc');
        Route::post('changeStatusTinTuc', 'Admin\TinTucController@changeStatusTinTuc');
        Route::post('changeMultipleStatusTinTuc', 'Admin\TinTucController@changeMultipleStatusTinTuc');
        Route::post('deleteTinTuc', 'Admin\TinTucController@deleteTinTuc');
        Route::post('deleteMultipleTinTuc', 'Admin\TinTucController@deleteMultipleTinTuc');
        Route::post('createTinTuc', 'Admin\TinTucController@createTinTuc');
        Route::post('updateTinTuc', 'Admin\TinTucController@updateTinTuc');
        Route::get('searchTinTuc', 'Admin\TinTucController@searchTinTuc');
      });
      Route::prefix('tintuyendung')->group(function () {
        Route::get('getTinTuyenDung', 'Admin\TinTuyenController@getTinTuyenDung');
        Route::post('changeStatusTinTuyenDung', 'Admin\TinTuyenController@changeStatusTinTuyenDung');
        Route::post('changeMultipleStatusTinTuyenDung', 'Admin\TinTuyenController@changeMultipleStatusTinTuyenDung');
        Route::post('deleteTinTuyenDung', 'Admin\TinTuyenController@deleteTinTuyenDung');
        Route::post('deleteMultipleTinTuyenDung', 'Admin\TinTuyenController@deleteMultipleTinTuyenDung');
        Route::post('changePublic', 'Admin\TinTuyenController@changePublic');
        Route::get('searchTinTuyenDung', 'Admin\TinTuyenController@searchTinTuyenDung');
        Route::post('createTinTuyen', 'Admin\TinTuyenController@createTinTuyen');
        Route::get('getDetailTinTuyen/{id}','Admin\TinTuyenController@getDetailTinTuyen');
        Route::post('updateTinTuyen', 'Admin\TinTuyenController@updateTinTuyen');
        Route::post('postView', 'Admin\ViewController@postView');
        Route::post('postSave', 'Admin\SaveController@postSave');
        Route::get('getSave', 'Admin\SaveController@getSave');
        Route::post('report', 'Admin\ReportController@report');
      });
      Route::prefix('hoso')->group(function () {
        Route::post('getProfileUser', 'Admin\TeamplateCvController@getProfileUser');
        Route::post('getEducationUser', 'Admin\TeamplateCvController@getEducationUser');
        Route::post('updateProfileUser', 'Admin\TeamplateCvController@updateProfileUser');
        Route::post('updateEducationUser', 'Admin\TeamplateCvController@updateEducationUser');
        Route::post('insertEducationUserOne', 'Admin\TeamplateCvController@insertEducationUserOne');
        Route::post('deleteDataEducation', 'Admin\TeamplateCvController@deleteDataEducation');
      });
      Route::prefix('apply')->group(function () {
        Route::get('getApplyWait', 'Admin\ApplyManageController@getApplyWait');
        Route::get('getApplyApproved', 'Admin\ApplyManageController@getApplyApproved');
        Route::get('getRefuseApply', 'Admin\ApplyManageController@getRefuseApply');
        Route::get('getAllApply', 'Admin\ApplyManageController@getAllApply');
        Route::get('ApproveApply/{id}', 'Admin\ApplyManageController@ApproveApply');
        Route::get('RefuseApply/{id}', 'Admin\ApplyManageController@RefuseApply');
        Route::get('HideApply/{id}', 'Admin\ApplyManageController@HideApply');
        Route::get('ShowApply/{id}', 'Admin\ApplyManageController@ShowApply');
        Route::get('DraftApply/{id}', 'Admin\ApplyManageController@DraftApply');
      });
  });
});

