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
    
    public function listProfileUser(){
        $response = $this->teamplateCvService->getProfileBy();
        return response()->json($response);
    }

    public function insertProfileUser(Request $request){                                  
        $validator = Validator::make($request->all(),
        [
            'fullname_profile' => 'required',
            'birthday_profile' => 'required',
            'maleFemale' => 'required',
            'address_profile' => 'required',
            'phone_profile' => 'required',
            'email_profile' => 'required', 
            'avatar_profile' => 'required',           
            'note_profile' => 'required',
            'title_target_profile' => 'required',
            'note_target_profile' => 'required',
            'skill_communication_profile' => 'required',
            'skill_information_profile' => 'required',
            'skill_logic_profile' => 'required',
            'certificate_profile' => 'required',
            'level_education' => 'required',
            'name_education' => 'required',
            'specialized_education' => 'required'           
        ],
        [
            'required' => 'Không được để trống',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ]);
        }
        if($request->file('file')){
            try {
                $file = $request->file('file');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                $uploadPath = '/home/netbee.vn/html/static/uploads/users/avatars';                

                $file->move($uploadPath, $image);
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }
        try {
            $insert = [
                'id_user'=> Auth::user()->id,
                'fullname_profile' => $request->fullname_profile,
                'birthday_profile' => $request->birthday_profile,
                'maleFemale' => $request->maleFemale,
                'address_profile' => $request->address_profile,
                'phone_profile' => $request->phone_profile,
                'email_profile' => $request->email_profile, 
                'avatar_profile' => $request->avatar_profile,              
                'note_profile' => $request->note_profile,
                'title_target_profile' => $request->title_target_profile,
                'note_target_profile' => $request->note_target_profile,
                'skill_communication_profile' => $request->skill_communication_profile,
                'skill_information_profile' => $request->skill_information_profile,
                'skill_logic_profile' => $request->skill_logic_profile,
                'certificate_profile' => $request->certificate_profile,
                'level_education' => $request->level_education,
                'name_education' => $request->name_education,
                'specialized_education' => $request->specialized_education,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
            $check = DB::table('profile_user')->insert($insert);               
            $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }            
        
        return response()->json($data);
    }    
   
}
