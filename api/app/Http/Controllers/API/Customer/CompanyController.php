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
    public function getInfoAll(){
        $this->nbCompanyInfoService->getInfoAll();
    }
}
