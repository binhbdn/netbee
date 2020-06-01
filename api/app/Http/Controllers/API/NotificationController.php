<?php

namespace App\Http\Controllers\API;

use App\Services\NotificationService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Response;

class NotificationController extends Controller
{

    protected $notificationService;
    protected $userService;

    public function __construct
    (
        NotificationService $notificationService, 
        UserService $userService
    ) {
        $this->notificationService = $notificationService;
        $this->userService = $userService;
    }

    public function getNotification()
    {
        $response = $this->notificationService->index();
        return response()->json($response);
    }

    public function postNotification(Request $request)
    {
        $ids = $this->userService->getIdAdmin()->pluck('id');
        $response = $this->notificationService->store($request->content, $ids, $request->url);
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
