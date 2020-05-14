<?php

namespace App\Http\Controllers\API;

use App\Services\NotificationService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class NotificationController extends Controller
{

    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function getNotification()
    {
        $response = $this->notificationService->index();
        return response()->json($response);
    }

    public function postNotification($content = null, $idRecever = null,  $url = null)
    {
        $response = $this->notificationService->store($content, $idRecever, $url);
        return response()->json($response);
    }

    public function readNotification(Request $request)
    {
        $response = $this->notificationService->updateById($request->id_notification);
        return response()->json($response);
    }

    public function readNotificationAll(Request $request)
    {
        $response = $this->notificationService->updateByRecever();
        return response()->json($response);
    }

}
