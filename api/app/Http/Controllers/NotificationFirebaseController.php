<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Response;
use Carbon\Carbon;

class NotificationFirebaseController extends Controller
{
    public static function sendCloudMessaseToNative($id_recived = null, $message = null, $type = null){
        $check = DB::table('admins')->where('id', $id_recived)->first();
        if(!$check){
            $data = ['status' => 400, 'message' => 'Lỗi gửi thông báo cho người nhận'];
        }else{
            $deviceToken = $check->firebase_token;
            $url = 'https://fcm.googleapis.com/fcm/send';
            $serverKey = "AIzaSyB35fN2ETg6PV01wNt0An7DU1V_CIeeQmQ";
            $msg = array(
                "message" => $message,
                "type" => $type
            );            
            $fields = array();
            $fields['data'] = $msg;
            $data = ['status' => 200, 'message' => 'Gửi thông báo thành công'];
            if (is_array($deviceToken)) {
                $fields['registration_ids'] = $deviceToken;
            } else {
                $fields['to'] = $deviceToken;
            }
            $headers = array(
                'Content-Type:application/json',
                'Authorization:key=' . $serverKey
            );   
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('FCM Send Error: '  .  curl_error($ch));
            }
            curl_close($ch);
        }
        return response()->json($data);
    }   
    

}
