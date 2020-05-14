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

class TinTuyenController extends Controller
{
    protected $tinTuyenService;

    public function __construct(TinTuyenService $tinTuyenService)
    {
        $this->tinTuyenService = $tinTuyenService;
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

    public function getDetailTinTuyen(Request $request)
    {
        $response = $this->tinTuyenService->show($request->id);
        return response()->json($response);
    }

    public function createTinTuyen(Request $request)
    {
        $response = $this->tinTuyenService->store($request);
        return response()->json($response);
    }

    public function updateTinTuyen(Request $request){
        $response = $this->tinTuyenService->updateJob($request);
        return response()->json($response);
    }
}
