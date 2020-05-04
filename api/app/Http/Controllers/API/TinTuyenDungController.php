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

use App\Http\Controllers\NotificationController as notifi;

class TinTuyenDungController extends Controller
{

    public function getTinTuyenDungNew(Request $request)
    {
        $limit = $request->limit;
        $type = $request->type;
        $datas['tintuyendung'] = DB::select('CALL GetTinTuyenDung('.$type.','.$limit.')');
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }
    public function getTinTuyenDungHot(Request $request)
    {
        $limit = $request->limit;
        $datas['tintuyendung'] = DB::select('CALL GetTinTuyenDungHot('.$limit.')');
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }
    public function getTinTuyenDungForCompany(Request $request)
    {
        $limit = $request->limit;
        $datas['tintuyendung'] = DB::select('CALL GetTinTuyenDungForCompany('.$request->id.','.$limit.')');
        $datas['count'] = DB::select('CALL GetTinTuyenDungForCompany('.$request->id.',0)');
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }

    public function getDetailTinTuyenDung(Request $request)
    {
        $tin = DB::select('CALL GetTinTuyenDungDetail('.$request->id.')');
        if($tin)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $tin];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }

}