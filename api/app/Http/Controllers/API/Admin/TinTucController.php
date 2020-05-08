<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\NewsService;
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

class TinTucController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getTinTuc()
    {
        $response = $this->newsService->getNews();
        return response()->json($response);
    }

    public function changeStatusTinTuc(Request $request)
    {
        $response = $this->newsService->changeStatus($request->id);
        return response()->json($response);
    }

    public function changeMultipleStatusTinTuc(Request $request)
    {
        $response = $this->newsService->changeMultiStatus($request);
        return response()->json($response);
    }

    public function deleteTinTuc(Request $request)
    {
        $response = $this->newsService->destroy($request->id);
        return response()->json($response);
    }

    public function deleteMultipleTinTuc(Request $request)
    {
        $response = $this->newsService->multiDestroy($request);
        return response()->json($response);
    }

    public function createTinTuc(Request $request)
    {
        $response = $this->newsService->store($request);
        return response()->json($response);
    }

    public function updateTinTuc(Request $request)
    {
        $response = $this->newsService->updateNews($request);
        return response()->json($response);
    }
    public function searchTinTuc(Request $request)
    {
        $response = $this->newsService->searchNews($request);
        return response()->json($response);
    }

}
