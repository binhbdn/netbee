<?php

namespace App\Http\Controllers\API;

use App\Services\HomeService;
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
    protected $homeService;

    public function __construct(HomeService $homeService)
    {
        $this->homeService = $homeService;
    }

    public function getNationHome(Request $request)
    {
        $response = $this->homeService->getNation();
        return response()->json($response);
    }

    public function getCategoriesJobHome(Request $request)
    {
        $nations = DB::table('nb_job_categories')->get();
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
    public function saveEmail(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email|unique:nb_data_emails',
            'name' => 'required',
            'phone' => 'required|numeric',
        ],
        [
            'required' => 'Không được để trống',
            'email' => 'Địa chỉ email không đúng định dạng',
            'numeric' => 'Số điện thoại không được chứa kí tự',
            'unique' => 'Địa chỉ email đã tồn tại trên hệ thống'
        ]);

        if ($validator->fails()) {
             return response()->json([
                 'status' => 400,
                 'message' => $validator->messages()->first(),
                 'data' => null
             ]);
        }
        $save = DB::table('nb_data_emails')->insert(array_merge($request->all(),[
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()

        ]));
        if($save)
            $data = ['status'=> 200, 'message' => 'Chúc mừng bạn! Chúng tôi sẽ liên lạc với bạn sớm nhất', 'data' => $save];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi', 'data' => null];
        return response()->json($data);
    }
}
