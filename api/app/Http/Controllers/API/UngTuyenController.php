<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApplyJobService;
use App\Services\UserService;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\API\NotificationController;

class UngTuyenController extends Controller
{
    protected $applyJobService;
    protected $userService;
    public function __construct(ApplyJobService $applyJobService, UserService $userService){
        $this->applyJobService = $applyJobService;
        $this->userService = $userService;
    }

    public function userApplyJob(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file_cv' => 'required|mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
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
        $admins = $this->userService->getIdAdmin();
        $file = $request->file('file_cv');
        $fileinfo = pathinfo($file->getClientOriginalName());
        $file_cv = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
        $uploadPath = '/home/netbee.vn/html/static/uploads/apply/';
        $insert = [
            'cv_file' => $file_cv,
            'job_id' => $request->job_id,
            'user_id' => Auth::user()->id,
            'name' => $request->name,
            'status' => 1,
            'bonus' => $this->applyJobService->getBonus($request->job_id),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $message = 'Có lượt ứng tuyển mới của tin ['.$request->job_id.']';
        foreach ($admins as $key => $admin) {
            NotificationController::postNotification($message, $admin->id, 'https://netbee.vn/admin/quan-ly-ung-tuyen');
        }
        $file->move($uploadPath, $file_cv );
        $check = $this->applyJobService->create($insert);
        if($check){
            $data = ['status' => 200,'message' => 'Ứng tuyển thành công', 'data' => null];
        }else{
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }
}
