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
        $response = $this->tinTuyenService->changeStatusJob($request->id);
        return response()->json($response);
    }

    public function changeMultipleStatusTinTuyenDung(Request $request)
    {
        $response = $this->tinTuyenService->changeStatusJobs($request);
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
        //Notification + Transaction Begin
        $notification = [
            'content' => 'Có tin tuyển dụng mới',
            'ids' => $this->userService->getIdAdmin()->pluck('id'),
            'url' => 'https://netbee.vn/admin/tin-tuyen-dung'
        ];
        DB::beginTransaction();
            $resTinTuyen = $this->tinTuyenService->store($request);
            $response = $this->notificationService->store($notification['content'], $notification['ids'], $notification['url']);
        if ($resTinTuyen && $response['status'] == 200) {
            DB::commit();
        } else {
            DB::rollback();
        }
        //Notification + Transaction End
        //$response = $this->tinTuyenService->store($request);
        return response()->json($resTinTuyen);
    }

    public function updateTinTuyen(Request $request){
        $response = $this->tinTuyenService->updateJob($request);
        return response()->json($response);
    }
}
