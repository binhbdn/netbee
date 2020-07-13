<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\BankHrService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;
use JWTAuth;
use Auth;
use Validator;
use Hash;
use Carbon\Carbon;

class BankHrController extends Controller
{
    protected $bankHrService;

    public function __construct( BankHrService $bankHrService)
    {
        $this->bankHrService = $bankHrService;
    }

    public function getByIt()
    {
        $response = $this->bankHrService->getByIt(Auth::user()->id);
        return response()->json($response);
    }

    public function store(Request $request)
    {
        $response = $this->bankHrService->store($request);
        return response()->json($response);
    }

    public function updateData(Request $request)
    {
        $response = $this->bankHrService->updateData($request);
        return response()->json($response);
    }

    public function EditData(Request $request)
    {
        $response = $this->bankHrService->EditData($request);
        return response()->json($response);
    }


}
