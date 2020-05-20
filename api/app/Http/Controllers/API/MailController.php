<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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
            return redirect('https://netbee.vn/dang-nhap')->with('success','Kích hoạt tài khoản thành công');
        }catch (Exception $exception){
            return response()->json([
                'status' => 400,
                'message' => 'Lỗi',
                'data'=> null
            ]);
        }


    }
}
