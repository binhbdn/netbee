<?php

namespace App\Http\Controllers\API;

use App\Services\SearchService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimKiemController extends Controller
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function searchCompany(Request $request){
        $response = $this->searchService->companies($request->keyword);
        return response()->json($response);
    }

    public function getQuocGia() {
        $response = $this->searchService->nations();
        return response()->json($response);
    }

    public function getVisa() {
        $response = $this->searchService->visas();
        return response()->json($response);
    }

    public function searchJobs(Request $request){
        $response = $this->searchService->jobs($request);
        return response()->json($response);
    }
}
