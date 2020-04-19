<?php
namespace App\Http\Controllers;
 
use App\Http\Controllers\Controller;
use App\Mail\Sendmail;
use Mail;
// use Illuminate\Support\Facades\Mail;
 
class MailController extends Controller
{
    public function send()
    {
    	$mail = 'trentoanthegioi@gmail.com';
 		$data = (object)[
 			'title' => 'Kính chào Quý công ty [Tên công ty]',
 			'content' => 'Cảm ơn Quý công ty đã đăng tin tuyển dụng việc làm trên website <a href="https://www.devwork.vn" style="color: #ffb701;">Devwork</a>',
 			'body' => 'Tin đăng tuyển dụng [Tên job] của Quý công ty đã được Ban quản trị <a href="https://www.devwork.vn" style="color: #ffb701;">Devwork</a> duyệt tại địa chỉ: [Link job]',
 			'contact_name' => 'giangmv',
 			'contact_phone' => '0969.333.883',
 			'contact_email' => 'contact@devwork.vn',
 		];
        Mail::to($mail)->send(new Sendmail($data));
        dd('mail send');
    }
}