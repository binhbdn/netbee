<?php

namespace App\Http\Controllers\API;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApplyJobService;
use App\Services\UserService;
use Validator;
use Auth;
use Carbon\Carbon;

class UngTuyenController extends Controller
{
    protected $applyJobService;
    protected $userService;
    protected $notificationService;

    public function __construct(
        ApplyJobService $applyJobService,
        UserService $userService,
        NotificationService $notificationService
    ){
        $this->applyJobService = $applyJobService;
        $this->userService = $userService;
        $this->notificationService = $notificationService;
    }

    public function userApplyJob(Request $request)
    {
        if(!empty($request->file('file_cv') && +($request->id_cv) != '')) {
            return response()->json([
                'status' => 400,
                'message' => 'Không thể chọn 2 file ',
                'data' => null
            ]);
        }
        $validator = Validator::make($request->all(),[
            'file_cv' => 'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,text/plain,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
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
        $insert = [
            'job_id' => $request->job_id,
            'user_id_submit' => Auth::user()->id,
            'user_id_recever' => $this->applyJobService->getIdCreated($request->job_id),
            'name' => $request->name,
            'status' => 1,
            'bonus' => $this->applyJobService->getBonus($request->job_id),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $file = $request->file('file_cv');
        if(!empty($file)){
            $insert['cv_file'] = $file;
            $fileinfo = pathinfo($file->getClientOriginalName());
            $file_cv = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
            $uploadPath = '/home/netbee.vn/html/static/uploads/apply/';
            $file->move($uploadPath, $file_cv );
        }
        if(+($request->id_cv) != ''){
            $insert['cv_id'] = $request->id_cv;
        }

        $message = 'Có lượt ứng tuyển mới của tin ['.$request->job_id.']';
        foreach ($admins as $key => $admin) {
            $url = 'https://netbee.vn/admin/quan-ly-ung-tuyen';
            $this->notificationService->store($message, $admin->id, $url);
//            NotificationController::postNotification($message, $admin->id, $url);
        }
        $check = $this->applyJobService->create($insert);
        if($check){
            $data = ['status' => 200,'message' => 'Ứng tuyển thành công', 'data' => null];
        }else{
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }
}
