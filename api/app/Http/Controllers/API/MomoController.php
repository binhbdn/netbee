<?php

namespace App\Http\Controllers\API;

use App\Services\MomoService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Auth;
use Validator;
use Hash;
use Carbon\Carbon;

class MomoController extends Controller
{
    protected $momoService;

    public function __construct(MomoService $momoService)
    {
        $this->momoService = $momoService;
    }

    public function checkDiscountCode(Request $request)
    {
        $response = $this->momoService->checkDiscountCode($request->code);
        return response()->json($response);
    }

    public function pricing_momo(Request $request)
    {
        $response = $this->momoService->pricing($request, MomoService::DEFAULT);
        return response()->json($response);
    }

    public function pricing_momo_bank(Request $request)
    {
        $response = $this->momoService->pricing($request, MomoService::BANK);
        return response()->json($response);
    }

    public function pricing_momo_bank_checking(Request $request)
    {
        $response = $this->momoService->checkPricing($request);
        return response()->json($response);
    }
    public function pricing_momo_verify_bank_checking(Request $request)
    {
        $response = $this->momoService->checkPricingVerify($request);
        return response()->json($response);
    }

    public function pricing_momo_verify(Request $request)
    {
        $response = $this->momoService->pricing_verify($request, MomoService::DEFAULT);
        return response()->json($response);
    }

}
