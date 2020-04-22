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

    public function getVisa() {
        try{
            $getQuocGia = DB::table('visa_profession')->get();
            $data = ['status'=> 200, 'message' => 'thành công', 'data' => $getQuocGia];
        } catch (\Exception $e){
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function getDetailTinTuyen(Request $request){
        try{
            $tin = DB::table('nb_joblists')->where('id', $request->id)->first();
            $data = ['status'=> 200, 'message' => 'thành công', 'data' => $tin];
        } catch (\Exception $e){
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function createTinTuyen(Request $request){
        if($request->get('type') == 2){
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'school_name' => 'required',
                'address' => 'required',
                'nation' => 'required',
                'expiration_date' => 'required',
                'description' => 'required',
                'request' => 'required',
                'cv_content' => 'required',
                'benefit' => 'required',
                'age_start' => 'required',
                'age_late' => 'required',
                'quantity' => 'required',
                'subsidy' => 'required',
                'currency' => "required",
                'date_start' => 'required',
                'date_test' => 'required',
                'expected_date' => 'required',
                'salary_start' => 'required',
                'salary_end' => 'required',
    
            ],[
                'required' => 'Vui lòng nhập đầy đủ thông tin của tin tuyển dụng!',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages()->first(),
                    'data' => null
                ]);
            }
            try {
                $insert = [
                    'title' => $request->get('title'),
                    'school_name' => $request->get('school_name'),
                    'workplace' => $request->get('address'),
                    'nation_id' => $request->get('nation'),
                    'expiration_date' => $request->get('expiration_date'),
                    'description' => $request->get('description'),
                    'request' => $request->get('request'),
                    'cv_content' => $request->get('cv_content'),
                    'benefit' => $request->get('benefit'),
                    'age_start' => $request->get('age_start'),
                    'age_late' => $request->get('age_late'),
                    'quantity' => $request->get('quantity'),
                    'salary_start' => $request->get('salary_start'),
                    'salary_end' => $request->get('salary_end'),
                    'subsidy' => $request->get('subsidy'),
                    'currency' => $request->get('currency'),
                    'date_start' => $request->get('date_start'),
                    'date_test' => $request->get('date_test'),
                    'expected_date' => $request->get('expected_date'),
                    'time_bonus' => $request->get('time_bonus'),
                    'bonus' => $request->get('bonus'),
                    'highlight_job' => $request->get('highlight_job'),
                    'type' => $request->get('type'),
                    'id_created' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $check = DB::table('nb_joblists')->insert($insert);
                $data = ['status' => 200,'message' => 'Tạo tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
            return response()->json($data);
        } else {
            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'address' => 'required',
                'nation' => 'required',
                'expiration_date' => 'required',
                'description' => 'required',
                'request' => 'required',
                'cv_content' => 'required',
                'benefit' => 'required',
                'age_start' => 'required',
                'age_late' => 'required',
                'quantity' => 'required',
                'subsidy' => 'required',
                'currency' => "required",
                'date_start' => 'required',
                'date_test' => 'required',
                'expected_date' => 'required',
                'salary_start' => 'required',
                'salary_end' => 'required',
                'visa' => 'required',
                'form_work' => 'required'
    
            ],[
                'required' => 'Vui lòng nhập đầy đủ thông tin của tin tuyển dụng!',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages()->first(),
                    'data' => null
                ]);
            }
            try {
                $insert = [
                    'title' => $request->get('title'),
                    'workplace' => $request->get('address'),
                    'nation_id' => $request->get('nation'),
                    'expiration_date' => $request->get('expiration_date'),
                    'description' => $request->get('description'),
                    'request' => $request->get('request'),
                    'cv_content' => $request->get('cv_content'),
                    'benefit' => $request->get('benefit'),
                    'age_start' => $request->get('age_start'),
                    'age_late' => $request->get('age_late'),
                    'quantity' => $request->get('quantity'),
                    'salary_start' => $request->get('salary_start'),
                    'salary_end' => $request->get('salary_end'),
                    'subsidy' => $request->get('subsidy'),
                    'currency' => $request->get('currency'),
                    'date_start' => $request->get('date_start'),
                    'date_test' => $request->get('date_test'),
                    'expected_date' => $request->get('expected_date'),
                    'time_bonus' => $request->get('time_bonus'),
                    'bonus' => $request->get('bonus'),
                    'highlight_job' => $request->get('highlight_job'),
                    'work_form' => $request->get('form_work'),
                    'id_visa' => $request->get('visa'),
                    'type' => $request->get('type'),
                    'id_created' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $check = DB::table('nb_joblists')->insert($insert);
                $data = ['status' => 200,'message' => 'Tạo tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
            return response()->json($data);
        }
    }

    public function postView(Request $request)
    {
        $check = DB::table('nb_job_views')->where('id_job', $request->id_job)->where('id_viewer', Auth::user()->id)->first();
        if($check)
        {
            $data = ['status' => 200,'message' => 'View thành công', 'data' => null];
        } else
        {
            DB::beginTransaction();
            try {
                $insert = [
                    'id_job' => $request->id_job,
                    'id_viewer' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                DB::table('nb_job_views')->insert($insert);
                $data = ['status' => 200,'message' => 'View thành công', 'data' => null];
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
        }
        return response()->json($data);
    }

    public function getSave(Request $request)
    {
        $check = DB::table('nb_job_saves')->where('id_job', $request->id_job)->where('id_saver', Auth::user()->id)->first();
        if($check)
        {
            $data = ['status' => 200,'message' => 'thành công', 'data' => true];
        }
        $data = ['status' => 200,'message' => 'thành công', 'data' => false];
        return response()->json($data);
    }

    public function postSave(Request $request)
    {
        if( Auth::user()->role == 4 ||  Auth::user()->role == 2)
            return response()->json(['status'=> 400, 'message' => 'Chức năng này chỉ dành cho ứng viên', 'data' => null]);
        $check = DB::table('nb_job_saves')->where('id_job', $request->id_job)->where('id_saver', Auth::user()->id)->first();
        if($check)
        {
            DB::beginTransaction();
            try {
                DB::table('nb_job_saves')->where('id_job', $request->id_job)->where('id_saver', Auth::user()->id)->delete();
                $data = ['status' => 200,'message' => 'Bỏ lưu thành công', 'data' => false];
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
        } else
        {
            DB::beginTransaction();
            try {
                $insert = [
                    'id_job' => $request->id_job,
                    'id_saver' => Auth::user()->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                DB::table('nb_job_saves')->insert($insert);
                $data = ['status' => 200,'message' => 'Lưu thành công', 'data' => true];
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
        }
        return response()->json($data);
    }
}
