<?php

namespace App\Http\Controllers\Api\Customer;

use App\Services\NbCompanyInfoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    //
    protected $nbCompanyInfoService;

    public function __construct(NbCompanyInfoService $nbCompanyInfoService)
    {
        $this->nbCompanyInfoService = $nbCompanyInfoService;
    }
    public function getListCompany(Request $request){
        $response = $this->nbCompanyInfoService->getListCompany($request->type, $request->limit, $request->perPage);

        return response()->json($response);
    }

    public function getListCompanyUser(Request $request){
        $response = $this->nbCompanyInfoService->getListCompanyUser($request->type, $request->limit, $request->perPage);

        return response()->json($response);
    }

    public function getDetailCompanyByID(Request $request)
    {
        $response = $this->nbCompanyInfoService->getDetailCompanyById($request->id);

        return response()->json($response);
    }
    public function postCompanyFeedback(Request $request)
    {
        $response = $this->nbCompanyInfoService->postCompanyFeedback($request);

        return response()->json($response);
    }
    public function followCompany(Request $request) {
        $data = $this->nbCompanyInfoService->followCompany($request);
        return response()->json($data);
    }
    public function checkFollow(Request $request) {
        $data = $this->nbCompanyInfoService->checkFollow($request);
        return response()->json($data);
    }
    public function countFollow(Request $request) {
        $data = $this->nbCompanyInfoService->countFollow($request);
        return response()->json($data);
    }
}
