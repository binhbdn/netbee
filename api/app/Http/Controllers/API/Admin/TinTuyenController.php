<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\TinTuyenService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Auth;
use Validator;
use Hash;
use Carbon\Carbon;
use App\Services\PayUService\Exception;
use App\Helpers\AppHelpers;
use App\Services\NotificationService;
use App\Services\UserService;

class TinTuyenController extends Controller
{
    protected $tinTuyenService;

    public function __construct(
        TinTuyenService $tinTuyenService,
        NotificationService $notificationService,
        UserService $userService   
    ){
        $this->tinTuyenService = $tinTuyenService;
        $this->notificationService = $notificationService;
        $this->userService = $userService;
    }

    public function getTinTuyenDung(){
        $response = $this->tinTuyenService->getJobs();
        return response()->json($response);
    }

    public function changeStatusTinTuyenDung(Request $request)
    {
        $id = $request->id;
        $response = $this->tinTuyenService->changeStatusJob($id);
        if($response['status'] == 200){
            $this->notificationStatus($response, $id);
        }
        return response()->json($response);
    }

    public function changeMultipleStatusTinTuyenDung(Request $request)
    {
        $response = $this->tinTuyenService->changeStatusJobs($request);
        if($response['status'] == 200){
            $ids = json_decode($request->id);
            foreach ($ids as $id){
                $this->notificationStatus($response, $id);
            }
        }

        return response()->json($response);
    }

    public function deleteTinTuyenDung(Request $request)
    {
        $response = $this->tinTuyenService->destroy($request->id);
        return response()->json($response);
    }

    public function deleteMultipleTinTuyenDung(Request $request)
    {
        $response = $this->tinTuyenService->destroyJobs($request->id);
        return response()->json($response);
    }

    public function changePublic(Request $request){
        $response = $this->tinTuyenService->changePublic($request->id);
        return response()->json($response);
    }

    public function searchTinTuyenDung(Request $request)
    {
        $response = $this->tinTuyenService->searchJob($request);
        return response()->json($response);
    }

    public function listcompany()
    {
        $response = $this->tinTuyenService->listcompany();
        return response()->json($response);
    }

    public function getDetailTinTuyen(Request $request)
    {
        $response = $this->tinTuyenService->show($request->id);
        return response()->json($response);
    }

    public function createTinTuyen(Request $request)
    {
        $response = $this->tinTuyenService->store($request);
        if($response['status'] == 200) {
            $notification = [
                'content' => 'Có tin tuyển dụng mới',
                'ids' => $this->userService->getIdAdmin()->pluck('id'),
                'url' => 'https://netbee.vn/admin/tin-tuyen-dung'
            ];
            $this->sendNotification($notification);
        }
        return response()->json($response);
    }

    public function updateTinTuyen(Request $request) {
        $id = $request->id;
        $response = $this->tinTuyenService->updateJob($request);
        if($response['status'] == 200) {
            $notification = [
                'content' => 'Hệ thống đã cập nhập lại tin tuyển dụng của bạn ['.$id.']',
                'ids' => $response['id_created'],
                'url' => 'https://netbee.vn/admin/tin-tuyen-dung/'.$id
            ];
            $this->sendNotification($notification);
        }
        return response()->json($response);
    }

    public function notificationStatus($response, $id){
        $id_created = $this->tinTuyenService->getUserIdByJobId($id);
        $status = $response['status_notification'];
        $baseUrl = 'https://netbee.vn/tin-tuyen-sinh/';
        $content = $status ? 
            'Tin tuyển dụng của bạn đã được duyệt ['.$id.']' :
            'Tin tuyển dụng của bạn đã bị hủy ['.$id.']';

        $url = $status ? $baseUrl.$id : $baseUrl;

        $notification = [
            'content' => $content,
            'ids' => $id_created,
            'url' => $url
        ];
        return $this->sendNotification($notification);
    }

    public function sendNotification($notification){
        $this->notificationService->store($notification['content'], $notification['ids'], $notification['url']);
    }

    public function getJobByRoleCompanyDash()
    {
        $response = $this->tinTuyenService->getJobByRoleCompanyDash();
        return response()->json($response);
    }
}
