<?php

namespace App\Http\Controllers\API;

use App\Services\JobServie;
use App\Services\TinTuyenDungService;
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
    protected $jobServie;
    public function __construct(JobServie $jobServie)
    {
        $this->jobServie = $jobServie;
    }

    public function getTinTuyenDungNew(Request $request)
    {
        $response = $this->jobServie->getTinTuyenDungNews($request->type,$request->limit);
        return response()->json($response);
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

    public function getTinTuyenDungNewCarousel(Request $request)
    {
        $datas['tintuyendung'] = DB::table('nb_joblists')
        ->leftJoin('users','users.id','=','nb_joblists.id_created')
        ->leftJoin('nations','nations.id','=','nb_joblists.nation_id')
        ->where('nb_joblists.status',1)
        ->where('nb_joblists.deleted',0)
        ->where('nb_joblists.isPublic',1)
        ->where('users.status',1)
        ->where('users.block',0)
        ->orderBy('nb_joblists.id','desc')
        ->select('nb_joblists.*','users.name','users.avatar','nations.name as nation_name')
        ->paginate(5);
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }
    public function getTinTuyenDungHotCarousel(Request $request)
    {
        $type = $request->type;
        $datas['tintuyendung'] = DB::table('nb_joblists')
        ->leftJoin('users','users.id','=','nb_joblists.id_created')
        ->leftJoin('nations','nations.id','=','nb_joblists.nation_id')
        ->where('nb_joblists.status',1)
        ->where('nb_joblists.deleted',0)
        ->where('nb_joblists.highlight_job',2)
        ->orWhere('nb_joblists.highlight_job',1)
        ->where('nb_joblists.isPublic',1)
        ->where('users.status',1)
        ->where('users.block',0)
        ->orderBy('nb_joblists.id','desc')
        ->select('nb_joblists.*','users.name','users.avatar','nations.name as nation_name')
        ->paginate(10);
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
