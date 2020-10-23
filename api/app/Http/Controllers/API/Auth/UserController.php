<?php

namespace App\Http\Controllers\API\Auth;

use App\Exports\UsersExport;
use App\Jobs\SendMailJobQueue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Mockery\Exception;
use Response;
use JWTAuth;
use JWTFactory;
use Auth;
use App\Mail\Contacs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Hash;
use Carbon\Carbon;
use App\Services\NotificationService;
use App\User;

class UserController extends Controller
{
    const
        ROLE_ADMIN = 4,
        ROLE_HR = 3,
        ROLE_COMPANY = 2,
        ROLE_STAFF = 1;
    protected $userService;
    protected $notificationService;

    public function __construct(
        UserService $userService,
        NotificationService $notificationService
    ) {
        $this->userService = $userService;
        $this->notificationService = $notificationService;
    }

    public function getidintroduce()
    {
        $response = $this->userService->getidintroduce();
        return response()->json($response);
    }

    public function ktintroduce(Request $request)
    {        
        $check =  $this->userService->checkIntroduce($request);
        if ($check) {
            return response()->json([
                'status'=> 200,
                'message' => 'Thành công',
                'data' => null
            ]);            
        } else{
            return response()->json([
                'status' => 400,
                'message' => 'Mã giới thiệu không chính xác',
                'data' => null
            ]);
        }
        
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric|unique:users',
            'role' => 'required|numeric|between:1,3',         
        ],
        [
            'required' => 'Không được để trống',
            'email' => 'Địa chỉ email không đúng định dạng',
            'numeric' => 'Số điện thoại không được chứa kí tự',
            // 'unique' => '::attribute đã tồn tại',
            'email.unique' =>  'Email đã tồn tại',
            'phone.unique' =>  'Số điện thoại đã đăng ký',
            'between' => 'Role không hợp lệ'
        ]);

        if ($validator->fails()) {
             return response()->json([
                 'status' => 400,
                 'message' => $validator->messages()->first(),
                 'data' => null
             ]);
        }                
        if ($request->role == self::ROLE_HR || $request->role == self::ROLE_STAFF) {   
            if($request->statust == 1){
                $users = [
                    'email' => $request->email,
                    'password' => bcrypt($request['password']),
                    'name' => $request['name'],
                    'phone' => $request['phone'],
                    'status' => '0',
                    'role' => $request->role,  
                    'introduce_code' => rand(10000,99999),
                    'introduce_ok_code' => $request->introduceOk,
                    'recover_code' => rand(100000,999999)
                ];
            }else{
                $users = [
                    'email' => $request->email,
                    'password' => bcrypt($request['password']),
                    'name' => $request['name'],
                    'phone' => $request['phone'],
                    'status' => '0',
                    'role' => $request->role,  
                    'introduce_code' => rand(10000,99999),
                    'recover_code' => rand(100000,999999)
                ];
            }                   
        }else{
            $users = [
                'email' => $request->email,
                'password' => bcrypt($request['password']),
                'name' => $request['name'],
                'phone' => $request['phone'],
                'status' => '0',
                'role' => $request->role,                  
                'recover_code' => rand(100000,999999)
            ];
        }
        //Notification Begin
        $notification = [
            'content' => 'Có tài khoản đăng ký mới ['.$users['email'].']',
            'ids' => $this->userService->getIdAdmin()->pluck('id'),
            'url' => 'https://netbee.vn/admin/quan-ly-tai-khoan?role='.$users['role']
        ];
        $response = $this->notificationService->store($notification['content'], $notification['ids'], $notification['url']);
        //Notification End
        $store = $this->userService->store($users);
        //Auto Login After Registration
        $credentials = [
            'email' => $email, 
            'password' => $password
        ];
        $jwtToken = $this->userService->login($credentials);
        // if (!$jwtToken) {
        //     return response()->json([
        //         'status' => 400,
        //         'message' => 'Email hoặc mật khẩu không đúng',
        //         'data' => null
        //     ]);
        // }
        // return response()->json([
        //     'status'  => 200,
        //     'message' => 'Đăng nhập thành công',
        //     'data' => [
        //         'user' => Auth::user(),
        //         'token' => $jwtToken
        //     ],
        // ]);
        if ($store) {
            $firstUserStore = $this->userService->firstEmailUsers($request->email);
            $notification1 = [
                'content' => 'Bạn cần hoàn thiện hồ sơ để đăng tin',
                'ids' => $this->userService->getIdUserDk($firstUserStore->id)->id,
                'url' => 'https://netbee.vn/admin/thong-tin-tai-khoan'
            ];
            $res = $this->notificationService->store($notification1['content'], $notification1['ids'], $notification1['url']);

            $dataEmail = (object)[
                'name' => $users['name'],
                'title' => 'Kích hoạt tài khoản Netbee',
                'content' => 'Chỉ còn 1 bước để có thể kích hoạt tài khoản Netbee. <br> Click ngay vào nút bên dưới để kích hoạt tài khoản của bạn.',
                'textButton' => 'Kích hoạt ngay',
                'url' => 'https://netbee.vn/api/activationByEmail?email='.$users['email'].'&code='.$users['recover_code']
            ];
            dispatch(new SendMailJobQueue($users['email'], $dataEmail));
            return response()->json([
                'status'=> 200,
                'message' => 'Đăng ký thành công',
                'data' => $jwtToken
            ]);
        }        

        return response()->json([
            'status'=> 400,
            'message' => 'Đăng ký thất bại',
            'data' => null
        ]);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'name' => 'required',
                'phone' => 'required|numeric',
            ],
            [
                'required' => 'Không được để trống :attribute',
                'numeric' => 'Số điện thoại không được chứa kí tự'
            ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ]);
        }
        if($request->file('avatar')) {
            try {
                $file = $request->file('avatar');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                $uploadPath = '/home/netbee.vn/html/static/uploads/users/avatars';
                //remove file old
                if(Auth::user()->avatar != NULL && file_exists($uploadPath.Auth::user()->avatar))
                {
                    unlink($uploadPath.Auth::user()->avatar);
                }
                $file->move($uploadPath, $image);
                $update = $this->userService->update(['avatar' => $image], $request->id);
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }else {
            $update = $this->userService->update($request->all(), $request->id);
        }
        if ($update) {
            return response()->json([
                'status'=> 200,
                'message' => 'Update thành công',
            ]);
        }
        return response()->json([
            'status'=> 400,
            'message' => 'Không có thông tin nào được thay đổi hoặc có lỗi trong khi thực hiện, vui lòng thực hiện lại',
        ]);
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
        $jwtToken = $this->userService->login($credentials);
        if (!$jwtToken) {
            return response()->json([
                'status' => 400,
                'message' => 'Email hoặc mật khẩu không đúng',
                'data' => null
            ]);
        }
        return response()->json([
            'status'  => 200,
            'message' => 'Đăng nhập thành công',
            'data' => [
                'user' => Auth::user(),
                'token' => $jwtToken
            ],
        ]);
    }

    public function logout()
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

    public function loginWithFacebook(Request $request)
    {
        $response = $this->userService->loginWithOAuth($request, $this->userService::FACEBOOK);
        return response()->json($response);
    }

    public function loginWithGoogle(Request $request)
    {
        $response = $this->userService->loginWithOAuth($request, $this->userService::GOOGLE);
        return response()->json($response);
    }

    public function user(Request $request)
    {
        $response['data'] = $this->userService->getUser();
        return response()->json($response);
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'password_old' => 'required',
            'password_new' => 'required',
            'password_new_confirm' => 'required|same:password_new',
        ],
        [
            'required' => 'Không được để trống',
            'same' => 'Mật khẩu xác thưc không trùng khớp'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ]);
        }

        $data = $this->userService->changePassword($request);
        return response()->json($data);
    }

    public function getInfoCompanyById(Request $request)
    {
        $response = $this->userService->getInfoCompanyById($request->id);
        return response()->json($response);
    }

    public function getCompanyHot(Request $request)
    {
        $response = $this->userService->getCompanyHot();
        return response()->json($response);
    }

    public function getCompanyNew(Request $request)
    {
        $response = $this->userService->getCompanyNew($request->limit);
        return response()->json($response);
    }

    public function changeInfo(Request $request)
    {
        $rules = [
            'birth_of_date' => 'required|before:today',
            'address_detail' => 'required',
            'phone' => 'required|numeric|digits:10',
            'name' => 'required',
        ];
        $messages = [
            'required' => 'Không được để trống',
            'numeric' => 'Số điện thoại không được chứa kí tự',
            'digits' => 'Số điện thoại phải có 10 chữ số',
            'before' => 'Ngày sinh không được lớn hơn ngày hiện tại'
        ];
        $update = [
            'birth_of_date' => $request->birth_of_date,
            'address_detail' => $request->address_detail,
            'phone' => $request->phone,
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ];

        if ($request->file('avatar')) {
            $rules['avatar'] = 'image';
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

        if($request->file('avatar')) {
            try {
                $file = $request->file('avatar');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                $uploadPath = '/home/netbee.vn/html/static/uploads/users/avatars';
                $update['avatar'] = $image;
                //remove file old
                if(Auth::user()->avatar != NULL && file_exists($uploadPath.Auth::user()->avatar))
                {
                    unlink($uploadPath.Auth::user()->avatar);
                }
                $file->move($uploadPath, $image);
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }
        $this->userService->update($update, Auth::user()->id);
        return response()->json([
            'status' => 200,
            'message' => 'Cập nhật tin thành công',
            'data' => null
        ]);
    }

    private function userRequest(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'name' => 'required',
            'phone' => 'required|numeric|unique:users',
        ];
        $messages = [
            'required' => 'Không được để trống',
            'email' => 'Địa chỉ email không đúng định dạng',
            'numeric' => 'Số điện thoại không được chứa kí tự',
            'email.unique' =>  'Email đã tồn tại',
            'phone.unique' =>  'Số điện thoại đã đăng ký',
            'password.min' => 'Mật khẩu tối thiểu 8 kí tự'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return [
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ];
        }
        return false;
    }

    public function createUserHr(Request $request)
    {
        $validate = $this->userRequest($request);
        if($validate) {
            return $validate;
        }
        $users = [
            'email' => $request->email,
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'phone' => $request['phone'],
            'status' => '0',
            'role' => '3'
        ];
        $store = $this->userService->store($users);

        if ($store) {
            return response()->json([
                'status'=> 200,
                'message' => 'Đăng ký thành công',
                'data' => null
            ]);
        }
        return response()->json([
            'status'=> 400,
            'message' => 'Đăng ký thất bại',
            'data' => null
        ]);
    }

    public function createUserCompany(Request $request)
    {
        $validate = $this->userRequest($request);
        if($validate) {
            return $validate;
        }
        $users = [
            'email' => $request->email,
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'phone' => $request['phone'],
            'status' => '0',
            'role' => '2'
        ];
        $store = $this->userService->store($users);

        if ($store) {
            return response()->json([
                'status'=> 200,
                'message' => 'Đăng ký thành công',
                'data' => null
            ]);
        }
        return response()->json([
            'status'=> 400,
            'message' => 'Đăng ký thất bại',
            'data' => null
        ]);
    }

    public function createUserUv(Request $request)
    {
        $validate = $this->userRequest($request);
        if($validate) {
            return $validate;
        }
        $users = [
            'email' => $request->email,
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'phone' => $request['phone'],
            'status' => '0',
            'role' => '1'
        ];
        $store = $this->userService->store($users);

        if ($store) {
            return response()->json([
                'status'=> 200,
                'message' => 'Đăng ký thành công',
                'data' => null
            ]);
        }
        return response()->json([
            'status'=> 400,
            'message' => 'Đăng ký thất bại',
            'data' => null
        ]);
    }

    public function get(Request $request)
    {
        $response = $this->userService->get($request);
        return response()->json($response);
    }

    public function getChoose(Request $request)
    {
        $response = $this->userService->getChoose($request);
        return response()->json($response);
    }

    public function search(Request $request, $userRole)
    {
        $response = $this->userService->search($request);
        return response()->json($response);
    }

    public function changeStatus(Request $request)
    {
        $response = $this->userService->changeStatus($request->id);
        return response()->json($response);
    }

    public function changeMultipleStatus(Request $request)
    {
        $response = $this->userService->changeMultiStatus($request);
        return response()->json($response);
    }

    public function blockUser(Request $request)
    {
        $response = $this->userService->blockUser($request);
        return response()->json($response);
    }

    public function blockMultipleUser(Request $request)
    {
        $response = $this->userService->blockMultipleUser($request);
        return response()->json($response);
    }
    public function activationByEmail(Request $request){
        try {
            $user = User::where('email',$request->email)->first();
            if($request->code == $user->recover_code){
                $user->update([
                    'status'=> 1,
                    'recover_code' => null
                ]);
                $dataEmail = (object)[
                    'name' => $user->name,
                    'title'=> 'Chào mừng ' . $user->name . ' đến với Netbee.',
                    'content' => 'Netbee kết nối đến hàng ngàn du học sinh và cộng tác viên tuyển dụng ở khắp mọi nơi ,
            Netbee trở thành mạng lưới giới thiệu và giải đáp thắc mắc lớn nhất Việt Nam.
            Netbee trở thành nơi tuyển dụng ưu việt, nhanh chóng, hiệu quả nhất cho các trung tâm tư vấn và môi giới du học trên khắp cả nước.
            <br>Netbee được ví như mạng lưới của những chú ong chăm chỉ, cần mẫn hàng ngày làm những công việc thầm lặng đưa những người con của đất Việt đi khắp muôn nơi trên thế giới.',
                    'textButton' => 'Đăng nhập Netbee',
                    'url' => 'https://netbee.vn/dang-nhap'
                ];
                $emailRegister = new SendMailJobQueue($user->email, $dataEmail);
                dispatch($emailRegister);
                return redirect('https://netbee.vn/dang-nhap?success')->with('success','Kích hoạt tài khoản thành công');
            }
        }catch (Exception $exception){
            return response()->json([
                'status' => 400,
                'message' => 'Lỗi',
                'data'=> null
            ]);
        }
    }

    public function export(Request $request){
        return Excel::download(new UsersExport(explode(',', $request->id)), 'Danh-sach-tai-khoan.xlsx');
    }
}
