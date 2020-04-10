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

class HomeController extends Controller
{
    public function getTinTucHome(Request $request)
    {
        $tin = DB::table('news')
        ->where('status', 1)
        ->where('deleted', 0)
        ->orderBy('id', 'DESC')
        ->limit(4)
        ->get();
        if($tin)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $tin];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }

    public function getNationHome(Request $request)
    {
        $nations = DB::table('nations')
        ->get();
        if($tin)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $nations];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get nations', 'data' => null];
        return response()->json($data);
    }

    public function getCategoriesJobHome(Request $request)
    {
        $nations = DB::table('nb_job_categories')
        ->get();
        if($tin)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $nations];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get nations', 'data' => null];
        return response()->json($data);
    }

    public function getTinTuyenSinhHome(Request $request)
    {
        $jobVip = DB::table('jobs_list')
        ->where('highlight_job', 1)
        ->where('deleted', 0)
        ->get();
        $jobNew = DB::table('jobs_list')
        ->where('highlight_job', 0)
        ->where('deleted', 0)
        ->orderBy('id', 'DESC')
        ->get();
        $jobDuHoc = DB::table('jobs_list')
        ->where('highlight_job', 0)
        ->where('deleted', 0)
        ->where('type', 2)
        ->get();
        $jobXKLD = DB::table('jobs_list')
        ->where('highlight_job', 0)
        ->where('deleted', 0)
        ->where('type', 1)
        ->get();
        $jobTNS = DB::table('jobs_list')
        ->where('highlight_job', 0)
        ->where('deleted', 0)
        ->where('type', 3)
        ->get();
        $job = [
            "jobVip" => $jobVip,
            "jobNew" => $jobNew,
            "jobDuHoc" => $jobDuHoc,
            "jobXKLD" => $jobXKLD,
            "jobTNS" => $jobTNS,
        ];
        if($job)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $job];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get nations', 'data' => null];
        return response()->json($data);
    }
}