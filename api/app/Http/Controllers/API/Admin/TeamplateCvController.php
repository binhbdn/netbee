<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\TeamplateCvService;
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

class TeamplateCvController extends Controller
{
    protected $teamplateCvService;

    public function __construct(TeamplateCvService $teamplateCvService)
    {
        $this->teamplateCvService = $teamplateCvService;
    }

    public function getProfileUser(Request $request){               
        $response = $this->teamplateCvService->getListProfileById($request->id);              
        return response()->json($response);
    }

    public function getEducationUser(Request $request){               
        $response = $this->teamplateCvService->getListEducationByIdUser($request->id);              
        return response()->json($response);
    }
    
}
