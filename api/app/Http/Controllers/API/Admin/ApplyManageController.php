<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApplyJobService;
use Response;
use App\Http\Controllers\API\NotificationController;
use App\Services\UserService;

class ApplyManageController extends Controller
{
    protected $applyJobService;
    protected $userService;
    public function __construct(ApplyJobService $applyJobService, UserService $userService)
    {
        $this->applyJobService = $applyJobService;
        $this->userService = $userService;
    }

    public function getApplyWait()
    {
        $applys = $this->applyJobService->getApply($this->applyJobService::CHO_DUYET);
        if($applys){
            $data = ['status' => 200, 'message' => 'thành công', 'data' => $applys]; 
        } else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function getApplyApproved() {
        $applys = $this->applyJobService->getApply($this->applyJobService::ADMIN_DUYET_CV);
        if($applys){
            $data = ['status' => 200, 'message' => 'thành công', 'data' => $applys]; 
        } else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function getRefuseApply() {
        $applys = $this->applyJobService->getApply($this->applyJobService::TU_CHOI);
        if($applys){
            $data = ['status' => 200, 'message' => 'thành công', 'data' => $applys]; 
        } else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function getAllApply() {
        $applys = $this->applyJobService->getApply($this->applyJobService::All);
        if($applys){
            $data = ['status' => 200, 'message' => 'thành công', 'data' => $applys]; 
        } else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function ApproveApply(Request $request){
        $approve = $this->applyJobService->changeStatusApply($request->id, $this->applyJobService::ADMIN_DUYET_CV);
        $detail = $this->applyJobService->getDetailApply($request->id);
        if($approve){
            NotificationController::postNotification('Hồ sơ của bạn đã được duyệt! Vui lòng hoàn tất giấy tờ liên quan', $detail->user_id_submit, 'https://netbee.vn/admin/quan-ly-ung-tuyen');
            $data = ['status' => 200, 'message' => 'thành công', 'data' => null];
        }else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function ApprovedApplyHoSo(Request $request){
        $approve = $this->applyJobService->changeStatusApply($request->id, $this->applyJobService::ADMIN_DUYET_HO_SO);
        $detail = $this->applyJobService->getDetailApply($request->id);
        if($approve){
            NotificationController::postNotification('Việc làm của bạn có lượt ứng tuyển mới', $detail->user_id_recever, 'https://netbee.vn/admin/quan-ly-ung-tuyen');
            $data = ['status' => 200, 'message' => 'thành công', 'data' => null];
        }else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function RefuseApply(Request $request){
        $approve = $this->applyJobService->refuse($request->id, $this->applyJobService::TU_CHOI, $request->reason_for_rejection);
        $detail = $this->applyJobService->getDetailApply($request->id);
        if($approve){
            NotificationController::postNotification('Yêu cầu ứng tuyển công việc '.$detail->job_id.' đã bị từ chối', $detail->user_id, 'https://netbee.vn/');
            $data = ['status' => 200, 'message' => 'thành công', 'data' => null];
        }else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function HideApply(Request $request){
        $check = $this->applyJobService->isPublic($request->id, $this->self::AN);
        if($check){
            $data = ['status' => 200, 'message' => 'thành công', 'data' => null];
        }else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }

    public function ShowApply(Request $request){
        $check = $this->applyJobService->isPublic($request->id, $this->self::HIEN);
        if($check){
            $data = ['status' => 200, 'message' => 'thành công', 'data' => null];
        }else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null]; 
        }
        return response()->json($data);
    }
}
