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
            'address_profile' => 'required',
            'name_education' => 'required',
            'phone_profile' => 'required',
            'email_profile' => 'required' 
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
            'link_facebook' => $request->link_facebook,                          
            'name_education' => $request->name_education,
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
            'address_profile' => 'required',
            'email_profile' => 'required',   
            'name_education' => 'required'                    
        ];
        $messages = [
            'required' => 'Không được để trống',           
        ];
        $update = [
            'id_user'=> Auth::user()->id,
            'fullname_profile' => $request->fullname_profile,
            'birthday_profile' => $request->birthday_profile,
            'address_profile' => $request->address_profile,
            'email_profile' => $request->email_profile,                        
            'name_education' => $request->name_education,    
            'updated_at' => Carbon::now(),
        ];

        if($request->type) {
            $update['type'] = $request->type;
        }

        if($request->maleFemale) {
            $update['maleFemale'] = $request->maleFemale;
        }

        if($request->phone_profile) {
            $update['phone_profile'] = $request->phone_profile;
        }

        if($request->link_facebook) {
            $update['link_facebook'] = $request->link_facebook;
        }
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
