<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Jobs\SendMailJobQueue;
use App\Jobs\SendRecoverPassword;
use App\Mail\Sendmail;
use App\Mail\WelcomeEmail;
use App\Models\Apply;
use App\Models\NbJoblist;
use App\User;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmail;
use App\Jobs\SendActivationRegisterMail;
use Illuminate\Support\Facades\Mail;
use Mockery\Exception;

class MailController extends Controller
{
    //
    public function welcomeEmail()
    {
        $emailWelcome = new SendWelcomeEmail();
        dispatch($emailWelcome);
    }
    public function resentActivationByEmail(Request $request)
    {
        $user = User::where('email',$request->email)->first();
        if($user){
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => 'Kích hoạt tài khoản Netbee',
                'content' => 'Chỉ còn 1 bước để có thể kích hoạt tài khoản Netbee. <br> Click ngay vào nút bên dưới để kích hoạt tài khoản của bạn.',
                'textButton' => 'Kích hoạt ngay',
                'url' => 'https://netbee.vn/api/activationByEmail?email='.$user->email.'&code='.$user->recover_code
            ];
            dispatch(new SendMailJobQueue($user->email, $dataEmail));
            return response()->json([
                'status' => 200,
                'message' => 'Vui lòng chờ!',
                'data' => null
            ]);
        }
        else{
            return response()->json([
                'status' => 400,
                'message' => 'Lỗi!',
                'data' => null
            ]);
        }
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
                'message' => 'Mã không hợp lệ! Vui lòng kiểm tra lại.',
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
            return response() -> json([
                'status' => 200,
                'message' => 'Thay đổi mật khẩu thành công!',
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

    public function sentMail(){
        $email = new WelcomeEmail();
        $send = Mail::to('bizinphu@gmail.com')->send($email);
    }

    public function sendActivationNews(Request $request){
        $dataInfo = (object)$this->getInfo($request->id);
        $data = (object)[
            'name' => $dataInfo->name,
            'email' => $dataInfo->email,
            'title' => '[THÔNG BÁO] Tin '.'"' . $dataInfo->titleJob. '"'.' của bạn đã được phê duyệt thành công!',
            'content' =>'Chúc mừng tin '. '"' . $dataInfo->titleJob. '"' .' của bạn đã được phê duyệt thành công.',
            'body' =>'Chúc mừng tin '. '" ' . $dataInfo->titleJob. '"' .' của bạn đã được phê duyệt thành công. Đăng nhập ngay vào Netbee để xem chi tiết tin của mình ngay nhé',
            'textButton' => 'Đăng nhập ngay',
            'urlButton' => 'https://netbee.vn/dang-nhap'
        ];
        dispatch(new SendMailJobQueue($data));
    }
//Có ứng viên vừa nạp CV yêu cầu Admin xem xét duyệt.
    public function sendToAdminHasNewsCV(Request $request){

    }
    public function sendMailApprovedCV(Request $request){
        //Gửi cho uv,hr đã duyệt CV -> yc gửi hồ sơ đính kèm
        $idApply = $request -> id;
        $applyInfo = Apply::where('id', $idApply)->first();
        $user = User::where('id',$applyInfo->user_id_submit)->first();
        $job = NbJoblist::where('id',$applyInfo->job_id)->first();
        $data = (object)[
            'name' => $user->name,
            'email' => $user->email,
            'title' => '[THÔNG BÁO] Hồ sơ ứng tuyển '.'"' . $job->title. '"'.' của bạn đã được phê duyệt thành công!',
            'content' =>'Chúc mừng hồ sơ '. ' "' . $job->title. '"' .' của bạn đã được bạn quan trị Netbee phê duyệt thành công',
            'body' =>"<b>Để hoàn thiện hồ sơ bạn cần chuẩn bị những giấy tờ sau:</b><br>1. Chứng minh thư nhân dân 2 mặt. <br> 2. Ảnh chân dung.
                    <br>3. Bằng tốt nghiệp các cấp. <br>4. Giấy khai sinh <br> 5. Sơ yếu lý lịch <br> 6. Giấy khám sức khỏe <br> 7. Hộ chiếu",
            'textBeforeButton' => 'Nếu đã có hồ sơ. Đăng nhập Netbee để nộp hồ sơ ngay!',
            'textButton' => 'Nộp hồ sơ ngay',
            'urlButton' => 'https://netbee.vn/admin/ho-so'
        ];
        dispatch(new SendMailJobQueue($data));

    }

    public function getInfo($id){
        $idJob = $id;
        $job = NbJoblist::where('id',$idJob)->first();
        $idUser = $job->id_created;
        $titleJob = $job->title;
        $user = User::where('id', $idUser)->first();
        $email = $user->email;
        $name = $user->name;
        $data = [
            'name' => $name,
            'titleJob' => $titleJob,
            'email' => $email
        ];
        return $data;
    }
}
