<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ViewService;

class ViewController extends Controller
{

    protected $viewService;

    public function __construct(ViewService $viewService)
    {
        $this->viewService = $viewService;
    }

    public function postView(Request $request)
    {
        $response = $this->viewService->postView($request->id_job);
        return response()->json($response);
    }
}
