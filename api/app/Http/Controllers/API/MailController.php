<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendRecoverPassword;
use App\User;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use App\Jobs\SendActivationRegisterMail;
use Mockery\Exception;

class MailController extends Controller
{
    //
    public function welcomeEmail()
    {
        $emailWelcome = new SendWelcomeEmail();
        dispatch($emailWelcome);
    }
    public function activationRegisterEmail(Request $request)
    {
        $emailRegister = new SendActivationRegisterMail($request);
        dispatch($emailRegister);
    }

    public function activationByEmail(Request $request){
        try {
            User::where('email',$request->email)->update([
                'status'=> 1
            ]);
            return redirect('https://netbee.vn/dang-nhap?success')->with('success','Kích hoạt tài khoản thành công');
        }catch (Exception $exception){
            return response()->json([
                'status' => 400,
                'message' => 'Lỗi',
                'data'=> null
            ]);
        }
    }

    public function recoverPassword(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user != null){
            if ($user->block ==1 ){
                return response() ->json([
                    'status' => 401,
                    'message' => 'Tài khoản của bạn đã bị khóa.',
                    'data'=> null
                ]);
            }
            else{
                $codeRecover = rand(100000,999999);
                User::where('email',$request->email)->update(['recover_code' => $codeRecover]);
                $data = [];
                $data['email'] = $request->email;
                $data['codeRecover'] = $codeRecover;
                $name = User::where('email', $request->email)->first()->name;
                $data['name'] = $name;
                $recoverPassword = new SendRecoverPassword($data);
                dispatch($recoverPassword);
                return response() ->json([
                    'status' => 200,
                    'message' => 'Vui lòng kiểm tra email.',
                    'data'=> null
                ]);
            }
        }
        else{
            return response() ->json([
                'status' => 402,
                'message' => 'Email của bạn không tồn tại.',
                'data'=> null
            ]);
        }
    }

    public function checkRecoverCode(Request $request) {
        $checkCode = User::where('email',$request->email)
            ->where('recover_code',$request->code)->first();
        if($checkCode){
            return response()->json([
                'status' => 200,
                'message' => 'Mã hợp lệ',
                'data' => null
            ]);
        }else{
            return response()->json([
                'status' => 400,
                'message' => 'Mã không hợp lệ',
                'data' => null
            ]);
        }
    }

    public function changePasswordForgot(Request $request){
        try{
            $user = User::where('email', $request->email)->first();
            $user->update([
                'password' => bcrypt($request->password)
            ]);
            dd($user);
            return response() -> json([
                'status' => 200,
                'message' => 'Thay đổi mật khẩu thành công',
                'data' => null
            ]);
        }catch (\Exception $exception){
            return response() -> json([
                'status' => 400,
                'message' => 'Lỗi',
                'data' => null
            ]);
        }
    }
}
