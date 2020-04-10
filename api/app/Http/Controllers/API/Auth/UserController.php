<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use JWTFactory;
use Auth;
use App\User;
use App\Mail\Contacs;
use Mail;
use Validator;
use Hash;
use Carbon\Carbon;
use App\Mail\Sendmail;

use App\Http\Controllers\NotificationController as notifi;

class UserController extends Controller
{
    public function create_hr(Request $request)
    {
        dd($request->email);
        $checkemail = DB::table('users')->where('email',$request->email)->count();
        $jwt_token = null;
        if($checkemail != 0)
        {
            $data = ['status'=> 400,'message' => 'Email của bạn đã tồn tại'];
        }
        else
        {
            $creatuser = array(
                    'email' => $request->email,
                    'password' => bcrypt($request['password']),
                    'name' => $request['fullname'],
                    'phone' => $request['phone'],
                    'status' => '0',
                    'type' => '3'
            );

            $users = DB::table('users')->insertGetId($creatuser);
            if($users)
            {
                $credentials = $request->only('email', 'password');
                if (!$jwt_token = JWTAuth::attempt($credentials)) {
                    return response()->json([
                        'status' => 400,
                        'message' => 'Invalid Email or Password',
                    ]);
                }
                if (JWTAuth::attempt($credentials)) {
                    $user = Auth::user();
                            $data = array(
                                'status'  => 200,
                                'message' => 'Đăng kí thành công. Vui lòng truy cập email đã đăng ký để kích hoạt tài khoản',
                                'user' => $user,
                                'token' => $jwt_token
                            );
                }
            }
            else
            {
                $data = ['status'=> 400, 'message' => 'Đăng ký thất bại'];
            }
        }
        return response()->json($data);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 400,
                'message' => 'Email hoặc mật khẩu không đúng',
            ]);
        }
        $data = array(
            'status'  => 200,
            'message' => 'Đăng nhập thành công',
            'user' => Auth::user(),
            'token' => $jwt_token
        );
      
        return response()->json($data);
    }

    public function loginfb(Request $request)
    {
        $id_provider = $request->id;
        $token = $request->token;
        $checkProvider = DB::table('social_accounts')->where('provider_user_id', $id_provider)->orderby('created_at', 'desc')->first();
        if($checkProvider) {
            $info = Admin::where('id', $checkProvider->user_id)->first();
            $customClaims = [
                'id' => $info->id,
                'level' => $info->level
            ];
            if($jwt_token = JWTAuth::fromUser($info, $customClaims)) {
                if($info){
                    if($info->avatar != null){
                        $info->avatar = $info->avatar;
                    }
                    try {
                        $input = [
                            'firebase_token' => $request->firebase_token,
                            'time_login' => Carbon::now()
                        ];
                        DB::table('admins')->where('email', $info->email)->update($input);
                        $user->firebase_token = $request->firebase_token;
                    } catch (\Throwable $th) {
                    }
                    $data = array(
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'user' => $info,
                        'token' => $jwt_token
                    );
                }
                else{
                    $data = array(
                        'status'  =>  400,
                        'message' => 'Tài khoản của bạn đã bị khóa'
                    );
                }
            }
            else
            {
                $data = array(
                    'status'  =>  400,
                    'message' => 'Sai tên đăng nhập hoặc mật khẩu.'
                );
            }
        } else {
            //check account fb
            $headers = array('Content-type: application/json');
            $url = "https://graph.facebook.com/me?fields=id,name,email,picture.type(large)&access_token=".$token;
            $http = curl_init($url);
            curl_setopt($http, CURLOPT_HEADER, false);
            curl_setopt($http, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($http, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($http, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($http, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($http, CURLOPT_VERBOSE, 0);
            curl_setopt($http, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($http, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($http, CURLOPT_HTTPHEADER, $headers);
            $result = curl_exec($http);
            curl_close($http);
            $inforesult = json_decode($result);
            //check unique email,phone
            $checkemail = DB::table('admins')->where('email',$inforesult->email)->count();
            $jwt_token = null;
            if($checkemail != 0)
            {
                $info = Admin::where('email', $inforesult->email)->first();
                if ($jwt_token = JWTAuth::fromUser($info)) {
                    if($info->avatar != null){
                        $info->avatar = $info->avatar;
                    }
                    try {
                        $input = [
                            'firebase_token' => $request->firebase_token,
                            'time_login' => Carbon::now()
                        ];
                        DB::table('admins')->where('email', $inforesult->email)->update($input);
                        $info->firebase_token = $request->firebase_token;
                    } catch (\Throwable $th) {
                    }
                    $data = array(
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'user' => $info,
                        'token' => $jwt_token
                    );
                }
            }
            else
            {
                $creatuser = array(
                        'email' => $inforesult->email,
                        'password' => bcrypt($inforesult->email),
                        'fullname' => $inforesult->name,
                        'username' => $inforesult->name,
                        'phone' => '',
                        'avatar' => $inforesult->picture->data->url,
                        'authen' => '2',
                        'status' => '0',
                        'country' => '2',
                        'level' => '3',
                        'victory_email' => 1,
                        'token_email' => md5('devwork'),
                        'created_at' => date('Y-m-d'),
                );

                $users = DB::table('admins')->insertGetId($creatuser);
                $info = Admin::where('id', $users)->first();
                if($users)
                {
                    DB::table('social_accounts')->insertGetId([
                        'user_id' => $users,
                        'provider_user_id' => $id_provider,
                        'provider' => 'facebook',
                        'created_at' => date('Y-m-d'),
                        'updated_at' => date('Y-m-d')
                    ]);
                    if ($jwt_token = JWTAuth::fromUser($info)) {
                        $list_user = DB::table('admins')->where('level',0)->where('authen',1)->orWhere('level', 4)->get();
                        $user = [];
                        foreach ($list_user as $key => $value) {
                        $user[] = ['user_id' => $value->id];
                        }
                        $id_user_action = $users;
                        $description = 'Vừa có tài khoản hr freelancer mới (chưa xác nhận) được tạo trên hệ thống';
                        $id_user_info = $user;
                        $url = 'https://www.devwork.vn/admin/index#/user/list-hr';
                        $notifi = notifi::create_notification($id_user_action, $description, $url, $id_user_info);


                        // $data = ['status'=> 200, 'message' => 'Vui lòng check mail để kích hoạt tài khoản. Nếu trong hộp thư không có vui lòng kiểm tra Tin Quảng Cáo hoặc Spam.'];
                        if($info->avatar != null){
                                    $info->avatar = $info->avatar;
                                }
                                try {
                                    $input = [
                                        'firebase_token' => $request->firebase_token,
                                        'time_login' => Carbon::now()
                                    ];
                                    DB::table('admins')->where('email', $inforesult->email)->update($input);
                                    $info->firebase_token = $request->firebase_token;
                                } catch (\Throwable $th) {
                                }
                                $data = array(
                                    'status'  => 200,
                                    'message' => 'Đăng kí thành công',
                                    'user' => $info,
                                    'token' => $jwt_token
                                );
                        $mail = $inforesult->email;
                        $url = 'https://www.devwork.vn/confirm-account/'.$users;
                        $dataemail = (object)[
                            'title' => 'Xác nhận tài khoản mới đăng ký',
                            'content' => 'Cảm ơn '.$inforesult->name.' đã đăng ký tài khoản tại <a href="https://www.devwork.vn" style="color: #ffb701;">DEVWORK.VN</a>',
                            'body' => 'Để truy cập vào <a href="https://www.devwork.vn" style="color: #ffb701;">DEVWORK.VN</a> vui lòng kích hoạt tài khoản vừa tạo:',
                            'confirm' => 1,
                            'url' => $url,
                        ];
                        Mail::to($mail)->queue(new Sendmail($dataemail));
                    }
                }
                else
                {
                    $data = ['status'=> 400, 'message' => 'Đăng ký thất bại'];
                }
            }
        }
        return response()->json($data);
    }

    public function logingg(Request $request)
    {
        $id_provider = $request->id;
        $email = $request->email;
        $name = $request->name;
        $avt = $request->avatar;
        $checkProvider = DB::table('social_accounts')->where('provider_user_id', $id_provider)->orderby('created_at', 'desc')->first();
        if($checkProvider) {
            $info = Admin::where('id', $checkProvider->user_id)->first();
            $customClaims = [
                'id' => $info->id,
                'level' => $info->level
            ];
            if($jwt_token = JWTAuth::fromUser($info, $customClaims)) {
                if($info){
                    if($info->avatar != null){
                        $info->avatar = $info->avatar;
                    }
                    try {
                        $input = [
                            'firebase_token' => $request->firebase_token,
                            'time_login' => Carbon::now()
                        ];
                        DB::table('admins')->where('email', $info->email)->update($input);
                        $user->firebase_token = $request->firebase_token;
                    } catch (\Throwable $th) {
                    }
                    $data = array(
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'user' => $info,
                        'token' => $jwt_token
                    );
                }
                else{
                    $data = array(
                        'status'  =>  400,
                        'message' => 'Tài khoản của bạn đã bị khóa'
                    );
                }
            }
            else
            {
                $data = array(
                    'status'  =>  400,
                    'message' => 'Sai tên đăng nhập hoặc mật khẩu.'
                );
            }
        } else {
            //check unique email,phone
            $checkemail = DB::table('admins')->where('email',$email)->count();
            $jwt_token = null;
            if($checkemail != 0)
            {
                $info = Admin::where('email', $email)->first();
                if ($jwt_token = JWTAuth::fromUser($info)) {
                    if($info->avatar != null){
                        $info->avatar = $info->avatar;
                    }
                    try {
                        $input = [
                            'firebase_token' => $request->firebase_token,
                            'time_login' => Carbon::now()
                        ];
                        DB::table('admins')->where('email', $inforesult->email)->update($input);
                        $info->firebase_token = $request->firebase_token;
                    } catch (\Throwable $th) {
                    }
                    $data = array(
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'user' => $info,
                        'token' => $jwt_token
                    );
                }
            }
            else
            {
                $creatuser = array(
                        'email' => $email,
                        'password' => bcrypt($email),
                        'fullname' => $name,
                        'username' => $name,
                        'phone' => '',
                        'avatar' => $avt,
                        'authen' => '2',
                        'status' => '0',
                        'country' => '2',
                        'level' => '3',
                        'victory_email' => 1,
                        'token_email' => md5('devwork'),
                        'created_at' => date('Y-m-d'),
                );

                $users = DB::table('admins')->insertGetId($creatuser);
                $info = Admin::where('id', $users)->first();
                if($users)
                {
                    DB::table('social_accounts')->insertGetId([
                        'user_id' => $users,
                        'provider_user_id' => $id_provider,
                        'provider' => 'facebook',
                        'created_at' => date('Y-m-d'),
                        'updated_at' => date('Y-m-d')
                    ]);
                    if ($jwt_token = JWTAuth::fromUser($info)) {
                        $list_user = DB::table('admins')->where('level',0)->where('authen',1)->orWhere('level', 4)->get();
                        $user = [];
                        foreach ($list_user as $key => $value) {
                        $user[] = ['user_id' => $value->id];
                        }
                        $id_user_action = $users;
                        $description = 'Vừa có tài khoản hr freelancer mới (chưa xác nhận) được tạo trên hệ thống';
                        $id_user_info = $user;
                        $url = 'https://www.devwork.vn/admin/index#/user/list-hr';
                        $notifi = notifi::create_notification($id_user_action, $description, $url, $id_user_info);


                        // $data = ['status'=> 200, 'message' => 'Vui lòng check mail để kích hoạt tài khoản. Nếu trong hộp thư không có vui lòng kiểm tra Tin Quảng Cáo hoặc Spam.'];
                        if($info->avatar != null){
                                    $info->avatar = $info->avatar;
                                }
                                try {
                                    $input = [
                                        'firebase_token' => $request->firebase_token,
                                        'time_login' => Carbon::now()
                                    ];
                                    DB::table('admins')->where('email', $email)->update($input);
                                    $info->firebase_token = $request->firebase_token;
                                } catch (\Throwable $th) {
                                }
                                $data = array(
                                    'status'  => 200,
                                    'message' => 'Đăng kí thành công',
                                    'user' => $info,
                                    'token' => $jwt_token
                                );
                        $mail = $email;
                        $url = 'https://www.devwork.vn/confirm-account/'.$users;
                        $dataemail = (object)[
                            'title' => 'Xác nhận tài khoản mới đăng ký',
                            'content' => 'Cảm ơn '.$name.' đã đăng ký tài khoản tại <a href="https://www.devwork.vn" style="color: #ffb701;">DEVWORK.VN</a>',
                            'body' => 'Để truy cập vào <a href="https://www.devwork.vn" style="color: #ffb701;">DEVWORK.VN</a> vui lòng kích hoạt tài khoản vừa tạo:',
                            'confirm' => 1,
                            'url' => $url,
                        ];
                        Mail::to($mail)->queue(new Sendmail($dataemail));
                    }
                }
                else
                {
                    $data = ['status'=> 400, 'message' => 'Đăng ký thất bại'];
                }
            }
        }
        return response()->json($data);
    }

}
