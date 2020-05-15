<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ApplyJobService;
use Response;
use App\Services\UserService;

class ApplyManageController extends Controller
{
    protected $applyJobService;
    protected $userService;
    protected $notificationService;

    public function __construct(
        ApplyJobService $applyJobService,
        UserService $userService,
        NotificationService $notificationService
    ) {
        $this->applyJobService = $applyJobService;
        $this->userService = $userService;
        $this->notificationService = $notificationService;
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
            $content = 'Hồ sơ của bạn đã được duyệt! Vui lòng hoàn tất giấy tờ liên quan';
            $url = 'https://netbee.vn/admin/quan-ly-ung-tuyen';
            $this->notificationService->store($content, $detail->user_id_submit, $url);
//            NotificationController::postNotification($content, $detail->user_id_submit, $url);
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
            $content = 'Việc làm của bạn có lượt ứng tuyển mới';
            $url = 'https://netbee.vn/admin/quan-ly-ung-tuyen';
            $this->notificationService->store($content, $detail->user_id_recever, $url);
//            NotificationController::postNotification($content, $detail->user_id_recever, $url);
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
            $content = 'Yêu cầu ứng tuyển công việc'.$detail->job_id.' đã bị từ chối';
            $url = 'https://netbee.vn/';
            $this->notificationService->store($content, $detail->user_id, $url);
//            NotificationController::postNotification($content, $detail->user_id, $url);
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

    public function ChooseCalendar(Request $request){
        $check = $this->applyJobService->ChooseCalendar($request->interview_schedules, $request->id);
        $detail = $this->applyJobService->getDetailApply($request->id);
        if($check){
            $content = 'Bạn đã được sắp lịch phỏng vấn công việc'.$detail->job_id.'.';
            $url = 'https://netbee.vn/admin/quan-ly-ung-tuyen';
            $this->notificationService->store($content, $detail->user_id_submit, $url);
//            NotificationController::postNotification($content, $detail->user_id_submit, $url);
            $data = ['status' => 200, 'message' => 'Đặt lịch phỏng vấn thành công'];
        } else {
            $data = ['status' => 400, 'message' => 'Đặt lịch phỏng vấn không thành công'];
        }
        return response()->json($data);
    }

    public function getPaperApply(Request $request)
    {
        $id = $request->id;
        $detail = $this->applyJobService->getPaperApply($id);
        if(!empty($detail)) {
            return [
                'status' => 200,
                'message' => 'Đã upload giấy tờ đính kèm',
                'data' => $detail
            ];
        }
        return [
            'status' => 400,
            'message' => 'Chưa upload giấy tờ đính kèm',
            'data' => null
        ];
    }

    public function PostPaperApply(Request $request)
    {
        $data = $this->applyJobService->postPaperApply($request);
        return response()->json($data);
    }

    public function ApprovedApplyHoSoDinhKem(Request $request){
        $approve = $this->applyJobService->changeStatusApply($request->id, $this->applyJobService::NTD_DUYET_HO_SO);
        $detail = $this->applyJobService->getDetailApply($request->id);
        if($approve){
            $data = ['status' => 200, 'message' => 'thành công', 'data' => null];
        }else {
            $data = ['status' => 400, 'message' => 'thất bại', 'data' => null];
        }
        return response()->json($data);
    }
}
