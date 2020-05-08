<?php

namespace App\Http\Controllers\API;

use App\Services\NewsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class TinTucController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getTinTucNew(Request $request)
    {
        $response = $this->newsService->getNewsClient($request);
        return response()->json($response);
    }

    public function getTinTucNewLoading(Request $request)
    {
        $response = $this->newsService->getNewsClient($request, 5);
        return response()->json($response);
    }

    public function getDetailTinTuc(Request $request)
    {
        $response = $this->newsService->getNewsDetailClient($request->id);
        return response()->json($response);
    }
}
