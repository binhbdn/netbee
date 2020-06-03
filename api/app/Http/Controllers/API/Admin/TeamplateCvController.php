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
use App\Services\NotificationService;
use App\Services\UserService;

class TeamplateCvController extends Controller
{
    protected $teamplateCvService;

    public function __construct(
        TeamplateCvService $teamplateCvService,
        NotificationService $notificationService,
        UserService $userService   
    ){
        $this->teamplateCvService = $teamplateCvService;
        $this->notificationService = $notificationService;
        $this->userService = $userService;
    }
    
    public function listProfileUser(){
        $response = $this->teamplateCvService->getProfileBy();
        return response()->json($response);
    }

    public function deleteProfileUser(Request $request)
    {
        $response = $this->teamplateCvService->destroy($request->id);
        return response()->json($response);
    }

    public function getProfileUserId(Request $request){
        $response = $this->teamplateCvService->getProfileId($request->id);
        return response()->json($response);
    }

    public function changeStatus(Request $request){
        $response = $this->teamplateCvService->changeStatus($request->id);
        return response()->json($response);
    }

    public function insertProfileUser(Request $request){                                       
        $rules = [
            'fullname_profile' => 'required',
            'birthday_profile' => 'required',
            'type' => 'required',
            'maleFemale' => 'required',
            'address_profile' => 'required',           
            'email_profile' => 'required', 
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
        ];
        $messages = [
            'required' => 'Không được để trống',           
        ];
        $insert = [
            'id_user'=> Auth::user()->id,
            'fullname_profile' => $request->fullname_profile,
            'birthday_profile' => $request->birthday_profile,
            'type' => $request->type,
            'maleFemale' => $request->maleFemale,
            'address_profile' => $request->address_profile,
            'phone_profile' => $request->phone_profile,
            'email_profile' => $request->email_profile,                          
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
        if ($request->file('avatar_profile')) {
            $rules['avatar_profile'] = 'image';
            $messages['image'] = 'Định dạng ảnh không phù hợp';            
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ]);
        }
        if($request->avatar_profile == 'undefined' || $request->avatar_profile == ''){
            return response()->json([
                'status' => 400,
                'message' => 'Ảnh đại diện không được bỏ trống',
                'data' => null
            ]);
        }
        $daystime = Carbon::parse($request->birthday_profile)->format('Y-m-d');
        $timedays = Carbon::now()->format('Y-m-d');
        if($daystime >=  $timedays){
            return response()->json([
                'status' => 400,
                'message' => 'Ngày sinh bắt buộc nhỏ hơn ngày hiện tại',
                'data' => null
            ]);
        }
        if($request->file('avatar_profile')) {
            try {
                $file = $request->file('avatar_profile');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                $uploadPath = '/home/netbee.vn/html/static/uploads/users/avatars';
                $insert['avatar_profile'] = $image;               
                $file->move($uploadPath, $image);
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }
        
        //Notification Begin
        $notification = [
            'content' => 'Có hồ sơ tạo mới ['.$insert['id_user'].']',
            'ids' => $this->userService->getIdAdmin()->pluck('id'),
            'url' => 'https://netbee.vn/admin/ho-so'
        ];
        $response = $this->notificationService->store($notification['content'], $notification['ids'], $notification['url']);
        //Notification End

        $this->teamplateCvService->insert($insert);
        return response()->json([
            'status' => 200,
            'message' => 'Tạo hồ sơ thành công',
            'data' => null
        ]);                                             
        return response()->json($data);
    }    
    public function updateProfileUser(Request $request)
    {
        $rules = [
            'fullname_profile' => 'required',
            'birthday_profile' => 'required',
            'type' => 'required',
            'maleFemale' => 'required',
            'address_profile' => 'required',
            'phone_profile' => 'required',
            'email_profile' => 'required',                     
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
        ];
        $messages = [
            'required' => 'Không được để trống',           
        ];
        $update = [
            'id_user'=> Auth::user()->id,
            'fullname_profile' => $request->fullname_profile,
            'birthday_profile' => $request->birthday_profile,
            'type' => $request->type,
            'maleFemale' => $request->maleFemale,
            'address_profile' => $request->address_profile,
            'phone_profile' => $request->phone_profile,
            'email_profile' => $request->email_profile,                         
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
            'updated_at' => Carbon::now(),
        ];

        if ($request->file('avatar_profile')) {
            $rules['avatar_profile'] = 'required|image';
            $messages['image'] = 'Định dạng ảnh không phù hợp';
        }


        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ]);
        }

        $daystime = Carbon::parse($request->birthday_profile)->format('Y-m-d');
        $timedays = Carbon::now()->format('Y-m-d');
        if($daystime >=  $timedays){
            return response()->json([
                'status' => 400,
                'message' => 'Ngày sinh bắt buộc nhỏ hơn ngày hiện tại',
                'data' => null
            ]);
        }

        if($request->file('avatar_profile')) {
            try {
                $file = $request->file('avatar_profile');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                $uploadPath = '/home/netbee.vn/html/static/uploads/users/avatars';
                $update['avatar_profile'] = $image;               
                $file->move($uploadPath, $image);
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }
        $this->teamplateCvService->updateProfile($update, $request->id);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật tin thành công',
            'data' => null
        ]);
    }
}
