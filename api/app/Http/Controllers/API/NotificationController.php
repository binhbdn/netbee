<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Auth;
use App\User;
use Validator;
use Hash;
use Carbon\Carbon;
use App\Mail\Sendmail;

class NotificationController extends Controller
{

    public function getNotification(Request $request)
    {
        $noti['notifications'] = DB::table('nb_notifications')->where('id_recever', Auth::user()->id)->orderBy('status_notification', 'ASC')->orderBy('created_at', 'DESC')->paginate(5);
        $noti['countNotRead'] = DB::table('nb_notifications')->where('status_notification', 0)->count();
        if($noti)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $noti];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get thông báo', 'data' => null];
        return response()->json($data);
    }

    public static function postNotification($content = null, $id_recever = null,  $url = null)
    {
        DB::beginTransaction();
        try {
            $insert = [
                'content' => $content,
                'id_recever' => $id_recever,
                'url' => $url,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            DB::table('nb_notifications')->insert($insert);
            $data = ['status' => 200,'message' => 'View thành công', 'data' => null];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function readNotification(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'status_notification' => 1,
                'updated_at' => Carbon::now()
            ];
            DB::table('nb_notifications')->where('id_notification', $request->id_notification)->update($update);
            $data = ['status' => 200,'message' => 'View thành công', 'data' => null];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function readNotificationAll(Request $request)
    {
        DB::beginTransaction();
        try {
            $update = [
                'status_notification' => 1,
                'updated_at' => Carbon::now()
            ];
            DB::table('nb_notifications')->where('id_recever', Auth::user()->id)->update($update);
            $data = ['status' => 200,'message' => 'View thành công', 'data' => null];
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }



}