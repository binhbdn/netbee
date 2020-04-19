<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Response;
use Carbon\Carbon;
class NotificationController extends Controller
{

  public static function create_notification($id_user_action = null, $description = null,  $url = null, $user_id = null){
  	$input = [
  		'id_user_action' => $id_user_action,
  		'description' => $description,
  		'url' => $url,
  		'time_create' => Carbon::now(),
  	];

    $create = DB::table('notifications')->insertGetId($input);
      if($create > 0){
        foreach ($user_id as $key => $value) {
          $inputs = [
            'id_notifi' => $create,
            'user_id' => $value['user_id']
          ];
          DB::table('notifications_used')->insert($inputs);
        }
      }
      //$notifi = DB::table('notifications')->select('*')->where('id_notifi',$create)->first();
      
      $a = DB::table('notifications')
      ->join('notifications_used', 'notifications.id_notifi', '=', 'notifications_used.id_notifi')
      ->select('*')
      ->where('notifications.id_notifi', '=', $create)
      ->get();
      $notifi = DB::table('notifications')
      ->select('*')
      ->where('id_notifi', '=', $create)
      ->first();
      $notifi->id_notification_used = $a->pluck('user_id')->all();
      return $notifi;
  }

  public function updateStatus(Request $request){
    $status = 1;
    $id = $request->id;
    $arr3 = [];
      $getNoti = DB::table('notification')
      ->select('id_user_info')
      ->where('id_notifi', $id)
      ->first();
      $convert = json_decode($getNoti->id_user_info);
      $convert = (object) $convert;
      foreach ($convert as $value) {
        if($value->user_id == Auth::guard('admin')->user()->id)
        {
            $value->status = 1;
            $arr[] = $value;
        }
        if($value->user_id != Auth::guard('admin')->user()->id)
        {
            $arr3[] = $value;
        }
      }
      if(count($arr3) == 0)
      {
        $arr1 = $arr;
      }
      else
      {
        $arr1 =array_merge($arr, $arr3);
      }

      $encode = json_encode($arr1);
    $input = [
      'id_user_info' => $encode,
    ];
    $check = DB::table('notification')->where('id_notifi',$id)->update($input);
      if ($check == true) {
          $msg = ['success' => 'success'];
      } else {
          $msg = ['error' => 'error'];
      }
      return response()->json(['msg' => $msg]);
  }

  public function change_status(Request $request){
  	$status = 1;
  	$id = $request->id;
  	$arr3 = [];
      $getNoti = DB::table('notification')
      ->select('id_user_info')
      ->where('id_notifi', $id)
      ->first();
      $convert = json_decode($getNoti->id_user_info);
      $convert = (object) $convert;
      foreach ($convert as $value) {
        if($value->user_id == Auth::guard('admin')->user()->id)
        {
            $value->status = 1;
            $arr[] = $value;
        }
        if($value->user_id != Auth::guard('admin')->user()->id)
        {
            $arr3[] = $value;
        }
      }
      if(count($arr3) == 0)
      {
      	$arr1 = $arr;
      }
      else
      {
      	$arr1 =array_merge($arr, $arr3);
      }

      $encode = json_encode($arr1);
  	$input = [
  		'id_user_info' => $encode,
  	];
  	$check = DB::table('notification')->where('id_notifi',$id)->update($input);
      if ($check == true) {
          $msg = ['success' => 'success'];
      } else {
          $msg = ['error' => 'error'];
      }
      return response()->json(['msg' => $msg]);
  }

  public function view_all(Request $request)
  {
    // if(Auth::guard('admin')->guest())
    // {
    //   $data = ['errorlogin' => 'Xin lỗi bạn chưa đăng nhập'];
    // }
    // else
    // {
      $getNoti = DB::table('notification')->select('id_notifi', 'id_user_info')->get();
      foreach ($getNoti as $key)
      {
          $this->updateStatus_all($key->id_notifi);
      }
    // }
  }

  public function updateStatus_all($id){
    $arr3 = [];
    $arr = [];
      $getNoti = DB::table('notification')
      ->select('id_user_info')
      ->where('id_notifi', $id)
      ->first();
      $convert = json_decode($getNoti->id_user_info);
      $convert = (object) $convert;
      foreach ($convert as $value) {
        if($value->user_id == Auth::guard('admin')->user()->id)
        {
            $value->status = 1;
            $arr[] = $value;
        }
        if($value->user_id != Auth::guard('admin')->user()->id)
        {
            $arr3[] = $value;
        }
      }
      if(count($arr3) == 0)
      {
        $arr1 = $arr;
      }
      else
      {
        $arr1 =array_merge($arr, $arr3);
      }

      $encode = json_encode($arr1);
    $input = [
      'id_user_info' => $encode,
    ];
    $check = DB::table('notification')->where('id_notifi',$id)->update($input);
      if ($check == true) {
          $msg = ['success' => 'success'];
      } else {
          $msg = ['error' => 'error'];
      }
      return response()->json(['msg' => $msg]);
  }
}
