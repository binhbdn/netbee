<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Services\ApplyJobService;
use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;

class FullCalendarController extends Controller
{
    protected $applyJobService;
    const
        CREATE = 1,
        JOIN = 2;

    public function __construct(ApplyJobService $applyJobService)
    {
        $this->applyJobService = $applyJobService;
    }
    
    public function getCalendar()
    {
        $response = $this->applyJobService->getCalendar();        
        return response()->json($response);
    }

    public function getCreateCall()
    {
        $response = $this->applyJobService->getCreateCall();
        return response()->json($response);
    }

    public function insertAddCall(Request $request)
    {        
        $insert = [
            'id_user'=> Auth::user()->id,
            'id_applies' => $request->id_applies,
            'id_room' => $request->id_room,
            'idjob' => $request->idjob,
            'created_at' => Carbon::now(),           
        ];
        $insertHis = [
            'id_user'=> Auth::user()->id,         
            'id_room' => $request->id_room,
            'action' => $request->action,
            'created_at' => Carbon::now(),        
        ];
        $update = [
            'status_call' => self::JOIN,
        ];
        $checkUp = $this->applyJobService->updateAppliesCall($update, $request->id_applies); 
        $check = $this->applyJobService->insertCreateCall($insert); 
        $checkHis = $this->applyJobService->insertHisCall($insertHis); 
        return response()->json([
            'status' => 200,
            'message' => 'Tạo hồ sơ thành công',
            'data' => null
        ]);   
    }
   public function insertHisCall(Request $request)
   {
        $insert = [
            'id_user'=> Auth::user()->id,         
            'id_room' => $request->id_room,
            'action' => $request->action,
            'created_at' => Carbon::now(),           
        ];
        $check = $this->applyJobService->insertHisCall($insert); 
        return response()->json([
            'status' => 200,
            'message' => 'Tạo hồ sơ thành công',
            'data' => null
        ]); 
   }

   public function getHisCall(Request $request)
   {
        $response = $this->applyJobService->getHisCall($request->id_room);        
        return response()->json($response);
   }

}
