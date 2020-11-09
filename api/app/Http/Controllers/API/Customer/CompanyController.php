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
    public function postVerifyByAdmin(Request $request)
    {
        $response = $this->nbCompanyInfoService->postVerifyByAdmin($request);
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

    public function getRating(Request $request) {
        $response = $this->nbCompanyInfoService->getRating($request->company_id);
        return response()->json($response);
    }

    public function getEmailCompany()
    {
        $response = $this->nbCompanyInfoService->getEmailCompany();
        return response()->json($response);
    }

    public function postEmailCompany(Request $request)
    {
        $response = $this->nbCompanyInfoService->postEmailCompany($request);
        return response()->json($response);
    }
    public function updateStatus0(Request $request)
    {
        $response = $this->nbCompanyInfoService->updateStatus0($request);
        return response()->json($response);
    }
    public function updateStatus1(Request $request)
    {
        $response = $this->nbCompanyInfoService->updateStatus1($request);
        return response()->json($response);
    }
    public function updateStatus2(Request $request)
    {
        $response = $this->nbCompanyInfoService->updateStatus2($request);
        return response()->json($response);
    }
    public function suaEmailCompany(Request $request)
    {
        $response = $this->nbCompanyInfoService->suaEmailCompany($request);
        return response()->json($response);
    }
    public function postDeleteEmailCompany(Request $request)
    {
        $response = $this->nbCompanyInfoService->postDeleteEmailCompany($request);
        return response()->json($response);
    }
}
