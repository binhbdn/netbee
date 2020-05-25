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
        if($user->exists()){
            if ($user->block ==1 ){
                return response() ->json([
                    'status' => 401,
                    'message' => 'Tài khoản của bạn đã bị khóa.',
                    'data'=> null
                ]);
            }
            else{
                $codeRecover = rand(100000,999999);
                $data = [];
                $data['email'] = $request->email;
                $data['codeRecover'] = $codeRecover;
                $name = User::where('email', $request->email)->first()->name;
                $data['name'] = $name;
                $recoverPassword = new SendRecoverPassword($data);
                dispatch($recoverPassword);
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
}
