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

    public function updateProfileUser(Request $request){    
        $getProfileUser = DB::table('profile_user')->where('id', $request->id)->where('deleted',0)->first();
        if($getProfileUser)
        {                        
            $validator = Validator::make($request->all(),
            [
                'fullname_profile' => 'required',
                'birthday_profile' => 'required',
                'maleFemale' => 'required',
                'address_profile' => 'required',
                'phone_profile' => 'required',
                'email_profile' => 'required',
                'cmnd_profile' => 'required',
                'note_profile' => 'required',
                'title_target_profile' => 'required',
                'note_target_profile' => 'required',
                'skill_communication_profile' => 'required',
                'skill_information_profile' => 'required',
                'skill_logic_profile' => 'required',
                'certificate_profile' => 'required'           
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
            try {
                $insert = [
                    'fullname_profile' => $request->fullname_profile,
                    'birthday_profile' => $request->birthday_profile,
                    'maleFemale' => $request->maleFemale,
                    'address_profile' => $request->address_profile,
                    'phone_profile' => $request->phone_profile,
                    'email_profile' => $request->email_profile,
                    'cmnd_profile' => $request->cmnd_profile,
                    'note_profile' => $request->note_profile,
                    'title_target_profile' => $request->title_target_profile,
                    'note_target_profile' => $request->note_target_profile,
                    'skill_communication_profile' => $request->skill_communication_profile,
                    'skill_information_profile' => $request->skill_information_profile,
                    'skill_logic_profile' => $request->skill_logic_profile,
                    'certificate_profile' => $request->certificate_profile,
                    'updated_at' => Carbon::now(),
                ];
                $check = DB::table('profile_user')->where('id', $request->id)->update($insert);               
                $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }            
        } else
        {
            $data = ['status'=> 400, 'message' => 'Tin đã bị xóa', 'data' => null];
        }
        return response()->json($data);
    }

    public function updateEducationUser(Request $request){    
        $getEducationUser = DB::table('education_user')->where('id', $request->id)->where('deleted',0)->first();
        if($getEducationUser)
        {                        
            $validator = Validator::make($request->all(),
            [
                'name_education' => 'required',
                'learning_education' => 'required',
                'business_education' => 'required',
                'from_datetime_education' => 'required',
                'to_datetime_education' => 'required'                         
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
            try {
                $insert = [
                    'name_education' => $request->name_education,
                    'learning_education' => $request->learning_education,
                    'business_education' => $request->business_education,
                    'from_datetime_education' => $request->from_datetime_education,
                    'to_datetime_education' => $request->to_datetime_education,
                    'updated_at' => Carbon::now(),
                ];
                $check = DB::table('education_user')->where('id', $request->id)->update($insert);               
                $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }            
        } else
        {
            $data = ['status'=> 400, 'message' => 'Tin đã bị xóa', 'data' => null];
        }
        return response()->json($data);
    }

    public function insertEducationUserOne(Request $request){
        try {
            $insert = [
                'id_profile_user' => $request->id_profile,
                'name_education' => '',
                'learning_education' => '',
                'business_education' => '',
                'from_datetime_education' => "2020-01-01",   
                'to_datetime_education' => "2020-01-01",   
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $check = DB::table('education_user')->insert($insert);
            $data = ['status' => 200,'message' => 'Tạo tin thành công', 'data' => null];
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function deleteDataEducation(Request $request){
        $response = $this->teamplateCvService->deleteEducation($request->id); 
        return response()->json($response);
    }
    
}
