<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApplyJobService;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\API\NotificationController;

class UngTuyenController extends Controller
{
    protected $applyJobService;
    public function __construct(ApplyJobService $applyJobService){
        $this->applyJobService = $applyJobService;
    }

    public function userApplyJob(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file_cv' => 'required|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'name' => 'required',
            'phone' => 'required'
        ],
        [
            'required' => 'Không được để trống',
            'mimetypes' => 'file không đúng định dạng'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ]);
        }
        $file = $request->file('file_cv');
        $fileinfo = pathinfo($file->getClientOriginalName());
        $file_cv = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
        $uploadPath = '/home/netbee.vn/html/static/uploads/apply/';
        $insert = [
            'name' => $request->name,
            'phone'=> $request->phone,
            'file_cv' => $file_cv,
            'job_id' => $request->job_id,
            'user_create' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $message = 'Có apply mới của tin ['.$request->job_id.']';
        NotificationController::postNotification($message, 9, 'https://netbee.vn/');
        $file->move($uploadPath, $file_cv );
        $check = $this->applyJobService->create($insert);
        if($check){
            $data = ['status' => 200,'message' => 'Tạo tin thành công', 'data' => null];
        }else{
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }
}
