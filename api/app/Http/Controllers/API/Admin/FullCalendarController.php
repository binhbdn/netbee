<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Services\ApplyJobService;
use App\Http\Controllers\Controller;
use Auth;

class FullCalendarController extends Controller
{
    protected $applyJobService;

    public function __construct(ApplyJobService $applyJobService)
    {
        $this->applyJobService = $applyJobService;
    }
    
    public function getCalendar()
    {
        $response = $this->applyJobService->getCalendar();        
        return response()->json($response);
    }

}
