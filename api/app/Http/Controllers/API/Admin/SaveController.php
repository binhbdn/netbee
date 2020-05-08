<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\SaveService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class SaveController extends Controller
{
    protected $saveService;

    public function __construct(SaveService $saveService)
    {
        $this->saveService = $saveService;
    }

    public function getSave(Request $request)
    {
        $response = $this->saveService->getSave($request->id_job);
        return response()->json($response);
    }

    public function postSave(Request $request)
    {
        $response = $this->saveService->postSave($request->id_job);
        return response()->json($response);
    }
}
