<?php

namespace App\Http\Controllers\API;

use App\Services\AdvertisementService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class AdvertisementController extends Controller
{
    protected $advertisement;

    public function __construct(AdvertisementService $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    public function getAdvertisement()
    {
        $response = $this->advertisement->getAdvertisement();
        return response()->json($response);
    }

    public function getIdAdvertisement(Request $request)
    {
        $response = $this->advertisement->getIdAdvertisement($request);
        return response()->json($response);
    }

    public function listAdvertisement()
    {
        $response = $this->advertisement->listAdvertisement();
        return response()->json($response);
    }

    public function updateAdvertisement(Request $request)
    {
        $response = $this->advertisement->updateAdvertisement($request);
        return response()->json($response);
    }

    public function insertAdvertisement(Request $request)
    {
        $response = $this->advertisement->store($request);
        return response()->json($response);
    }

    public function changeStatus(Request $request)
    {
        $response = $this->advertisement->changeStatus($request);
        return response()->json($response);
    }

    public function deleted(Request $request){
        $response = $this->advertisement->deleted($request);
        return response()->json($response);
    }
}
