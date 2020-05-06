<?php 
namespace App\Services;

use App\User;
use JWTAuth;
use Auth;
use DB;
use Hash;

class UserService {
    const 
        ROLE_ADMIN = 4,
        ROLE_HR = 3,
        ROLE_COMPANY = 2,
        ROLE_STAFF = 1;
    
    const 
        BLOCK = 1,
        UN_BLOCK = 0;

    const 
        FACEBOOK = 'facebook',
        GOOGLE = 'google';

    protected $user;
    protected $socialAccountService;

    public function __construct
    (
        User $user,
        SocialAccountService $socialAccountService
    ) {
        $this->user = $user;
        $this->socialAccountService = $socialAccountService;
    }

    public function update($data, $userId)
    {
        return $this->user->whereId($userId)->update($data);
    }
    
    public function store($data)
    {
        return $this->user->insert($data);
    }

    public function login($data)
    {
        return JWTAuth::attempt($data);
    }

    public function getUserById($userId)
    {
        return $this->user->whereBlock(self::UN_BLOCK)->whereId($userId);
    }

    public function getIdAfterStore($data)
    {
        return $this->user->insertGetId($data);
    }

    public function loginWithOAuth($request, $typeOAuth)
    {
        $token = $request->token;
        //check account fb
        $headers = array('Content-type: application/json');
        $url = $typeOAuth == self::FACEBOOK ? 
        "https://graph.facebook.com/me?fields=id,name,email,picture.type(large)&access_token=".$token : 
        "https://www.googleapis.com/oauth2/v1/userinfo?alt=json&access_token=".$token;
    
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
        $infoResult = json_decode($result);
        if (!$infoResult) {
            return [
                'status'  => 400,
                'message' => 'Lỗi',
                'data' => null,
            ];
        }
        $checkProvider = $this->socialAccountService->getProviderByProviderUserId($infoResult->id);
        if ($checkProvider) {
            $info = $this->getUserById($checkProvider->user_id)->first();
            if ($jwtToken = JWTAuth::fromUser($info)) {
                if ($info) {
                    return [
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'data' => ['user' => Auth::user(), 'token' => $jwtToken],
                    ];
                }
                return [
                    'status'  => 400,
                    'message' => 'Tài khoản của bạn đã bị khóa',
                    'data' => null,
                ];
            }
            return [
                'status'  => 400,
                'message' => 'Lỗi',
                'data' => null,
            ];
        }
    
        if (isset($request->role)) {
            $role = !in_array($request->role, [self::ROLE_HR, self::ROLE_COMPANY]) ? self::ROLE_STAFF : $request->role;
            //check unique email,phone
            $queryEmail = $this->user->whereEmail($infoResult->email);
            $jwtToken = JWTAuth::fromUser($queryEmail->first());
            
            if ($queryEmail->exists() && $jwtToken) {
                return [
                    'status'  => 200,
                    'message' => 'Đăng nhập thành công',
                    'data' => [
                        'user' => Auth::user(), 
                        'token' => $jwtToken
                    ],
                ];
            }
            $avatar = $typeOAuth == self::FACEBOOK ? $infoResult->picture->data->url : $infoResult->picture;
            $users = [
                'email' => $infoResult->email,
                'password' => bcrypt('123456'),
                'name' => $infoResult->name,
                'avatar' => $avatar,
                'phone' => 0,
                'status' => '0',
                'role' => $role
            ];
            $userId = $this->getIdAfterStore($users);
            $info = $this->getUserById($userId)->fitst();

            if ($userId) {
                $this->socialAccountService->store([
                    'user_id' => $userId,
                    'provider_user_id' => $infoResult->id,
                    'provider' => $typeOAuth,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                if ($jwtToken = JWTAuth::fromUser($info)) {
                    return [
                        'status'  => 200,
                        'message' => 'Đăng nhập thành công',
                        'data' => ['user' => Auth::user(), 'token' => $jwtToken],
                    ];
                }
            }
            return [
                'status'  => 400,
                'message' => 'Lỗi',
                'data' => null,
            ];
        }
        return [
            'status'  => 201,
            'message' => 'Chưa chọn role',
            'data' => null,
        ];
    }

    public function changePassword($data)
    {
        $userId = Auth::user()->id;
        $hashPassword = $this->getUserById($userId)->value('password');
        if (Hash::check($data->password_old, $hashPassword)) {
            $update = $this->user->whereId($userId)->update([
                'password' => Hash::make($data->password_new)
            ]);
            if ($update) {
                return [
                    'status' => 200,
                    'message' => 'Cập nhật mật khẩu thành công', 
                    'data' => null
                ];
            }
            return [
                'status' => 400,
                'message' => 'Có lỗi xảy ra', 
                'data' => null
            ];
        }
        return [
            'status'=> 400, 
            'message' => 'Mật khẩu cũ không đúng', 
            'data' => null
        ];
    }
    public function countUser($data)
    {
        $users = $this->user->whereRole($data)->count();
        return [
            'status' => 200,
            'message' => 'Thành công', 
            'data' => $users
        ];
    }
} 