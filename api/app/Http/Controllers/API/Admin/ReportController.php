<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\ReportService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{

    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function report(Request $request)
    {
        $response = $this->reportService->store($request);
        return response()->json($response);
    }
}
