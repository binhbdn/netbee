<?php
namespace App\Services;

use App\Jobs\SendActivationRegisterMail;
use App\Jobs\SendMailJobQueue;
use App\User;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Validator;

class UserService extends BaseService {

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
        return $this->user->create($data);
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
        $user = Auth::user();
        $userId = $user->id;
        $hashPassword = $this->getUserById($userId)->value('password');
        if (Hash::check($data->password_old, $hashPassword)) {
            $update = $this->user->whereId($userId)->update([
                'password' => Hash::make($data->password_new)
            ]);
            if ($update) {
                $dataEmail = [
                    'name' => $user->name,
                    'title' => 'Đổi mật khẩu Netbee',
                    'content' => 'Mật khẩu của bạn đã được thay đổi vào lúc '. $user->updated_at . '<br style="padding-top: 10px"> <b>Nếu bạn đã làm điều này,</b> bạn có thể bỏ qua email này một cách an toàn.
                                 <br><b>Nếu bạn đã không làm điều này, </b> vui lòng bảo vệ tài khoản của bạn. <br>',
                    'textButton' => 'Đăng nhập Netbee',
                    'url' => 'https://netbee.vn/dang-nhap'
                ];
                $sendEmail = new SendMailJobQueue($user->email, $dataEmail);
                dispatch($sendEmail);
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
        $users = $this->user->whereRole($data)->whereBlock(self::UN_BLOCK)->count();
        return [
            'status' => 200,
            'message' => 'Thành công',
            'data' => $users
        ];
    }

    public function getIdAdmin()
    {
        return $this->user->whereBlock(self::UN_BLOCK)->whereRole(self::ROLE_ADMIN)->get();
    }

    public function get()
    {
        return $this->user->whereBlock(self::UN_BLOCK)->whereRole(self::ROLE_COMPANY)->get();
    }

    public function getChoose()
    {
        return $this->user->whereBlock(self::UN_BLOCK)->whereRole(self::ROLE_COMPANY)->whereStatus(self::ACTIVE)->get();
    }

    public function search($request)
    {
        $roles = self::getRoles();
        if (!in_array($request->userRole, $roles)) {
            return abort(404, 'Role không hợp lệ');
        }
        $perPage = 10;
        $search = $request->search;
        $searchStatus = $request->searchStatus;
        $searchBlock = $request->searchBlock;
        $searchName = $request->searchName;
        $searchFromDate = $request->searchFromDate;
        $searchToDate = $request->searchToDate;
        $conditions =[];

        if($searchStatus != ''){
            $conditions[] = [
                'status',
                '=',
                $searchStatus
            ];
        }
        if($searchBlock != ''){
            $conditions[] = [
                'block',
                '=',
                $searchBlock
            ];
        }
        if($searchName != ''){
            $conditions[] = [
                'name',
                'LIKE',
                '%'.$searchName.'%'
            ];
        }

        $queryBlock = $this->user->whereRole($request->userRole);
        if ($searchBlock == self::ACTIVE) {
            $queryBlock->whereBlock(self::ACTIVE);
            return $queryBlock->orderBy('id', 'DESC')->paginate($perPage);
        }

        $query = $this->user->whereBlock(self::INACTIVE)->whereRole($request->userRole);
        if (Auth::user()->role != self::ROLE_ADMIN) {
            $query->whereUserCreated(Auth::user()->id);
        }
        if($searchFromDate != '' && $searchToDate != ''){
            $query->whereBetween('created_at', [$searchFromDate, $searchToDate]);
        }
        if (!empty($conditions)) {
            $query->where($conditions);
        }
        if ($search != '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%'.$search.'%')
                    ->orWhere('id','LIKE', '%'.$search.'%')
                    ->orWhere('email','LIKE', '%'.$search.'%');
            });
        }
        return $query->orderBy('id', 'DESC')->paginate($perPage);
    }

    public function changeStatus($id)
    {
        try {
            $user = $this->getUserById($id)->first();
            if($user) {
                $data = [
                    'status' => !$user->status,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Thay đổi trạng thái thành công',
                    'data' => $this->update($data, $id)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tài khoản không tồn tại',
                'data' => null
            ];

        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function changeMultiStatus($request)
    {
        if(empty($request->id)){
            return [
                'status'=> 400,
                'message' => 'Bạn chưa chọn tài khoản!',
                'data' => null
            ];
        }
        $ids = json_decode($request->id);
        $status = $request->status;
        try {
            $message = $status ? 'Kích hoạt thành công' : 'Bỏ kích hoạt thành công';
            $this->user->whereIn('id', $ids)->update([
                'status' => $status,
                'updated_at' =>  Carbon::now()
            ]);
            return [
                'status'=> 200,
                'message' => $message,
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function getUser()
    {
        return $this->user->with('nbCompany')->where('id', Auth::user()->id)->first();
    }

    public function getInfoCompanyById($id)
    {
        $columns = ['name', 'phone', 'avatar', 'address_detail', 'birth_of_date'];
        $user = $this->user->with('nbCompany')
            ->select($columns)
            ->whereId($id)
            ->whereStatus(self::ACTIVE)
            ->whereBlock(self::INACTIVE)
            ->get();
        if($user) {
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $user
            ];
        }
        return [
            'status'=> 400,
            'message' => 'Công ty không tồn tại',
            'data' => null
        ];
    }

    public function getCompanyHot()
    {
        $columns = ['name', 'phone', 'avatar', 'address_detail', 'birth_of_date'];
        $user = $this->user->with('nbCompany')
            ->select($columns)
            ->whereHas('nbCompany', function ($q) {
                $q->whereCompanyVerify(self::ACTIVE);
            })
            ->whereStatus(self::ACTIVE)
            ->whereBlock(self::INACTIVE)
            ->limit(9)
            ->get();

        if($user) {
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $user
            ];
        }
        return [
            'status'=> 400,
            'message' => 'Công ty không tồn tại',
            'data' => null
        ];
    }

    public function getCompanyNew($limit)
    {
        $columns = ['name', 'phone', 'avatar', 'address_detail', 'birth_of_date'];
        $query = $this->user->with('nbCompany')
            ->select($columns)
            ->whereStatus(self::ACTIVE)
            ->whereBlock(self::INACTIVE);
        if (!empty($limit)) {
            $query->limit($limit);
        }
        $user = $query->orderBy('id', 'DESC')->get();
        if($user) {
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $user
            ];
        }
        return [
            'status'=> 400,
            'message' => 'Công ty không tồn tại',
            'data' => null
        ];
    }

    public function blockUser($request)
    {
        try {
            $user = $this->getUserById($request->id)->first();
            if($user) {
                $data = [
                    'block' => self::BLOCK,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Block tài khoản thành công',
                    'data' => $this->update($data, $request->id)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tài khoản không tồn tại',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function blockMultipleUser($request)
    {
        if(empty($request->id)){
            return [
                'status'=> 400,
                'message' => 'Bạn chưa chọn tài khoản!',
                'data' => null
            ];
        }
        $ids = json_decode($request->id);
        try {
            $this->user->whereIn('id', $ids)->update([
                'block' => self::BLOCK,
                'updated_at' =>  Carbon::now()
            ]);
            return [
                'status'=> 200,
                'message' => 'Block tài khoản thành công',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }
}
