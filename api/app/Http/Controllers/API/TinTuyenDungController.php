<?php

namespace App\Http\Controllers\API;

use App\Services\TinTuyenDungService;
use App\Services\TinTuyenService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Auth;
use Validator;
use Hash;

class TinTuyenDungController extends Controller
{
    protected $tinTuyenService;
    public function __construct(TinTuyenService $tinTuyenService)
    {
        $this->tinTuyenService = $tinTuyenService;
    }

    public function getTinTuyenDungNew(Request $request)
    {
        $response = $this->tinTuyenService->getTinTuyenDungNews($request->type, $request->limit);
        return response()->json($response);
    }

    public function getTinTuyenDungNewPage(Request $request)
    {
        $response = $this->tinTuyenService->getTinTuyenDungPageNews($request->perPage);
        return response()->json($response);
    }

    public function getTinTuyenDungHot(Request $request)
    {
        $response = $this->tinTuyenService->getNewsHot($request->limit);
        return response()->json($response);
    }

    public function getTinTuyenDungNewCarousel(Request $request)
    {
        $response = $this->tinTuyenService->getTinTuyenDungNewCarousel();
        return response()->json($response);
    }
    public function getTinTuyenDungHotCarousel(Request $request)
    {
        $response = $this->tinTuyenService->getTinTuyenDungNewCarousel(true);
        return response()->json($response);
    }
    public function getTinTuyenDungForCompany(Request $request)
    {
        $response = $this->tinTuyenService->getTinTuyenDungForCompany($request);
        return response()->json($response);
    }

    public function getDetailTinTuyenDung(Request $request)
    {
        $response = $this->tinTuyenService->getDetailNew($request->id);
        return response()->json($response);
    }

}
