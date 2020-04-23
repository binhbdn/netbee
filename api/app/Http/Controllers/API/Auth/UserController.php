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
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'role' => 'required',
        ],
        [
            'required' => 'Không được để trống',
            'email' => 'Địa chỉ email không đúng định dạng',
            'numeric' => 'Số điện thoại không được chứa kí tự'
        ]);
         
        if ($validator->fails()) {
             return response()->json([
                 'status' => 400,
                 'message' => $validator->messages()->first(),
                 'data' => null
             ]);
        }
        $checkemail = DB::table('users')->where('email',$request->email)->count();
        $jwt_token = null;
        if($checkemail != 0)
        {
            $data = ['status'=> 400,'message' => 'Email của bạn đã tồn tại', 'data'=> null];
        }
        else
        {
            switch ($request->role) {
                case '1':
                    $creatuser = array(
                        'email' => $request->email,
                        'password' => bcrypt($request['password']),
                        'name' => $request['name'],
                        'phone' => $request['phone'],
                        'status' => '0',
                        'role' => 1
                        );
                    break;
                case '2':
                    $creatuser = array(
                        'email' => $request->email,
                        'password' => bcrypt($request['password']),
                        'name' => $request['name'],
                        'phone' => $request['phone'],
                        'status' => '0',
                        'role' => 2
                        );
                    break;
                case '3':
                    $creatuser = array(
                        'email' => $request->email,
                        'password' => bcrypt($request['password']),
                        'name' => $request['name'],
                        'phone' => $request['phone'],
                        'status' => '0',
                        'role' => 3
                        );
                    break;
                default:
                $creatuser = array(
                    'email' => $request->email,
                    'password' => bcrypt($request['password']),
                    'name' => $request['name'],
                    'phone' => $request['phone'],
                    'status' => '0',
                    'role' => 1
                    );
                    break;
            }
            $users = DB::table('users')->insertGetId($creatuser);
            if($users)
            {
                $data = ['status'=> 200, 'message' => 'Đăng ký thành công', 'data' => null];
            }
            else
            {
                $data = ['status'=> 400, 'message' => 'Đăng ký thất bại', 'data' => null];
            }
        }
        return response()->json($data);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email',
            'password' => 'required'
        ],
        [
            'required' => 'Không được để trống',
            'email' => 'Địa chỉ email không đúng định dạng'
        ]);
         
        if ($validator->fails()) {
             return response()->json([
                 'status' => 400,
                 'message' => $validator->messages()->first(),
                 'data' => null
             ]);
        }
        $credentials = $request->only('email', 'password');
        $jwt_token = null;
        if (!$jwt_token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'status' => 400,
                'message' => 'Email hoặc mật khẩu không đúng',
                'data' => null
            ]);
        }
        $data = array(
            'status'  => 200,
            'message' => 'Đăng nhập thành công',
            'data' => ['user' => Auth::user(), 'token' => $jwt_token],
        );
        return response()->json($data);
    }

    public function logout(Request $request) 
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());
            $data = array(
                'status'  => 200,
                'message' => 'Đăng xuất thành công',
                'data' => null,
            );
            return response()->json($data);
        } catch (JWTException $e) {
            $data = array(
                'status'  => 400,
                'message' => 'Có lỗi xảy ra',
                'data' => null,
            );
            return response()->json($data);
        }
    }

    public function loginfb(Request $request)
    {
        $token = $request->token;
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
        $checkProvider = DB::table('social_accounts')->where('provider_user_id', $inforesult->id)->orderby('created_at', 'desc')->first();
        if($checkProvider) {
            $info = User::where('id', $checkProvider->user_id)->where('block', 0)->first();
            if($jwt_token = JWTAuth::fromUser($info)) {
                if($info){
                    $data = array(
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'data' => ['user' => Auth::user(), 'token' => $jwt_token],
                    );
                }
                else{
                    $data = array(
                        'status'  => 400,
                        'message' => 'Tài khoản của bạn đã bị khóa',
                        'data' => null,
                    );
                }
            }
            else
            {
                $data = array(
                    'status'  => 400,
                    'message' => 'Lỗi',
                    'data' => null,
                );
            }
        } else {
            //check unique email,phone
            $checkemail = DB::table('users')->where('email',$inforesult->email)->count();
            $jwt_token = null;
            if($checkemail != 0)
            {
                $info = User::where('email', $inforesult->email)->first();
                if ($jwt_token = JWTAuth::fromUser($info)) {
                    $data = array(
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'data' => ['user' => Auth::user(), 'token' => $jwt_token],
                    );
                }
            }
            else
            {
                $creatuser = array(
                    'email' => $inforesult->email,
                    'password' => bcrypt('123456'),
                    'name' => $inforesult->name,
                    'avatar' => $inforesult->picture->data->url,
                    'phone' => 0,
                    'status' => '0',
                    'role' => 1
                    );

                $users = DB::table('users')->insertGetId($creatuser);
                $info = User::where('id', $users)->first();
                if($users)
                {
                    DB::table('social_accounts')->insertGetId([
                        'user_id' => $users,
                        'provider_user_id' => $inforesult->id,
                        'provider' => 'facebook',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    if ($jwt_token = JWTAuth::fromUser($info)) {
                        $data = array(
                            'status'  => 200,
                            'message' => 'Đăng nhập thành công',
                            'data' => ['user' => Auth::user(), 'token' => $jwt_token],
                        );
                    }
                }
                else
                {
                    $data = array(
                        'status'  => 400,
                        'message' => 'Lỗi',
                        'data' => null,
                    );
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

    public function user(Request $request)
    {
        return [
            'data' => JWTAuth::parseToken()->authenticate()
        ];
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'password_old' => 'required',
            'password_new' => 'required',
            'password_new_confirm' => 'required',
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
            $getPass = DB::table('users')->where('id', Auth::user()->id)->first();
            if(Hash::check($request->password_old, $getPass->password))
            {
                $insert = [
                    'password' => Hash::make($request->password_new)
                ];
                DB::table('users')->where('id', Auth::user()->id)->update($insert);
                $data = ['status' => 200,'message' => 'Cập nhật mật khẩu thành công', 'data' => null];
            }
            else
            {
                $data = ['status'=> 400, 'message' => 'Mật khẩu cũ không đúng', 'data' => null];
            }
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function getInfoCompany(Request $request)
    {
        try {
            $get = DB::table('nb_companies_info')->where('company_id', Auth::user()->id)->first();
            if($get)
            {
                $data = ['status' => 200,'message' => 'Thành công', 'data' => $get];
            }
            else
            {
                $data = ['status'=> 400, 'message' => 'Bạn chưa cập nhật thông tin công ty', 'data' => null];
            }
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function getInfoCompanyById(Request $request)
    {
        $GetCompanyDetail = DB::select('CALL GetCompanyDetail('.$request->id.')');
        if($GetCompanyDetail)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $GetCompanyDetail];
        else
            $data = ['status'=> 400, 'message' => 'Công ty không tồn tại', 'data' => null];
        return response()->json($data);
    }

    public function getCompanyHot(Request $request)
    {
        $GetCompanyHot = DB::select('CALL GetCompanyHot()');
        if($GetCompanyHot)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $GetCompanyHot];
        else
            $data = ['status'=> 400, 'message' => 'Công ty không tồn tại', 'data' => null];
        return response()->json($data);
    }

    public function getCompanyNew(Request $request)
    {
        $limit = $request->limit;
        $GetCompanyNew = DB::select('CALL GetCompanyNew('.$limit.')');
        if($GetCompanyNew)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $GetCompanyNew];
        else
            $data = ['status'=> 400, 'message' => 'Công ty không tồn tại', 'data' => null];
        return response()->json($data);
    }

    public function changeInfo(Request $request)
    {
        if($request->file('avatar'))
        {
            $validator = Validator::make($request->all(),
            [
                'birth_of_date' => 'required',
                'address_detail' => 'required',
                'phone' => 'required|numeric',
                'avatar' => 'required|image',
                'name' => 'required',
            ],
            [
                'required' => 'Không được để trống',
                'image' => 'Định dạng ảnh không phù hợp',
                'numeric' => 'Số điện thoại không được chứa kí tự'
            ]);
            
            if ($validator->fails()) {
                 return response()->json([
                     'status' => 400,
                     'message' => $validator->messages()->first(),
                     'data' => null
                 ]);
            }
            try {
                $file = $request->file('avatar');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                $uploadPath = '/home/en-el.devwork.vn/public_html/static/uploads/users/avatars';
                $insert = [
                    'birth_of_date' => $request->birth_of_date,
                    'address_detail' => $request->address_detail,
                    'phone' => $request->phone,
                    'avatar' => $image,
                    'name' => $request->name,
                    'updated_at' => Carbon::now()
                ];
                //remove file old
                if(Auth::user()->avatar != NULL && file_exists($uploadPath.Auth::user()->avatar))
                {
                    unlink($uploadPath.Auth::user()->avatar);
                }
                $file->move($uploadPath, $image);
                $check = DB::table('users')->where('id', Auth::user()->id)->update($insert);
                $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
        } else 
        {
            $validator = Validator::make($request->all(),
            [
                'birth_of_date' => 'required',
                'address_detail' => 'required',
                'phone' => 'required|numeric',
                'name' => 'required',
            ],
            [
                'required' => 'Không được để trống',
                'numeric' => 'Số điện thoại không được chứa kí tự'
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
                    'birth_of_date' => $request->birth_of_date,
                    'address_detail' => $request->address_detail,
                    'phone' => $request->phone,
                    'name' => $request->name,
                    'updated_at' => Carbon::now()
                ];
                $check = DB::table('users')->where('id', Auth::user()->id)->update($insert);
                $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
        }
        return response()->json($data);
    }

    public function changeInfoCompany(Request $request)
    {
        $get = DB::table('nb_companies_info')->where('company_id', Auth::user()->id)->first();
        if(!$get)
        {
            $validator = Validator::make($request->all(),
            [
                'company_hotline' => 'required|numeric',
                'company_about' => 'required',
                'company_tax' => 'required|numeric',
                'company_benefit' => 'required',
                'company_policy' => 'required',
                'company_chance' => 'required',
                'company_link' => 'required'
            ],
            [
                'required' => 'Không được để trống',
                'numeric' => 'Số điện thoại không được chứa kí tự'
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
                    'company_id' => Auth::user()->id,
                    'company_hotline' => $request->company_hotline,
                    'company_about' => $request->company_about,
                    'company_tax' => $request->company_tax,
                    'company_benefit' => $request->company_benefit,
                    'company_policy' => $request->company_policy,
                    'company_chance' => $request->company_chance,
                    'company_link' => $request->company_link,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ];
                $check = DB::table('nb_companies_info')->insert($insert);
                $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
        }
        else
        {
            $validator = Validator::make($request->all(),
            [
                'company_hotline' => 'required|numeric',
                'company_about' => 'required',
                'company_tax' => 'required|numeric',
                'company_benefit' => 'required',
                'company_policy' => 'required',
                'company_chance' => 'required',
                'company_link' => 'required'
            ],
            [
                'required' => 'Không được để trống',
                'numeric' => 'Số điện thoại không được chứa kí tự'
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
                    'company_hotline' => $request->company_hotline,
                    'company_about' => $request->company_about,
                    'company_tax' => $request->company_tax,
                    'company_benefit' => $request->company_benefit,
                    'company_policy' => $request->company_policy,
                    'company_chance' => $request->company_chance,
                    'company_link' => $request->company_link,
                    'updated_at' => Carbon::now()
                ];
                $check = DB::table('nb_companies_info')->where('company_id', Auth::user()->id)->update($insert);
                $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
            } catch (\Exception $e) {
                $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
            }
        }
        return response()->json($data);
    }

}
