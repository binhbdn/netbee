<?php

namespace App\Http\Controllers\API\Admin;

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
use App\Services\PayUService\Exception;
use App\Helpers\AppHelpers;

use App\Http\Controllers\NotificationController as notifi;

class TinTuyenController extends Controller
{
    public function getQuocGia() {
        try{
            $getQuocGia = DB::table('nations')->get();
            $data = ['status'=> 200, 'message' => 'thành công', 'data' => $getQuocGia];
        } catch (\Exception $e){
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }
}
