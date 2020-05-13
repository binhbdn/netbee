<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use JWTFactory;
use Auth;
use App\Mail\Contacs;
use Mail;
use Validator;
use Hash;
use Carbon\Carbon;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'name' => 'required',
            'phone' => 'required|numeric',
            'role' => 'required|numeric|between:1,3',
        ],
        [
            'required' => 'Không được để trống',
            'email' => 'Địa chỉ email không đúng định dạng',
            'numeric' => 'Số điện thoại không được chứa kí tự',
            'unique' => 'Email đã tồn tại',
            'between' => 'Role không hợp lệ'
        ]);

        if ($validator->fails()) {
             return response()->json([
                 'status' => 400,
                 'message' => $validator->messages()->first(),
                 'data' => null
             ]);
        }

        $users = [
            'email' => $request->email,
            'password' => bcrypt($request['password']),
            'name' => $request['name'],
            'phone' => $request['phone'],
            'status' => '0',
            'role' => $request->role
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
        $rules = [
            'birth_of_date' => 'required',
            'address_detail' => 'required',
            'phone' => 'required|numeric',
            'name' => 'required',
        ];
        $messages = [
            'required' => 'Không được để trống',
            'numeric' => 'Số điện thoại không được chứa kí tự'
        ];
        $update = [
            'birth_of_date' => $request->birth_of_date,
            'address_detail' => $request->address_detail,
            'phone' => $request->phone,
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ];

        if ($request->file('avatar')) {
            $rules['avatar'] = 'required|image';
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

    public function getAllNTD(Request $request)
    {
        $response = $this->userService->getAllNTD($request);
        return response()->json($response);
    }

    public function searchNTD(Request $request)
    {
        $response = $this->userService->searchNTD($request);
        return response()->json($response);
    }

    public function changeStatusNTD(Request $request)
    {
        $response = $this->userService->changeStatus($request->id);
        return response()->json($response);
    }

    public function changeMultipleStatusNTD(Request $request)
    {
        $response = $this->userService->changeMultiStatus($request);
        return response()->json($response);
    }
}
