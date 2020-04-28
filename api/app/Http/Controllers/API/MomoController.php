<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Auth;
use App\User;
use Validator;
use Hash;
use Carbon\Carbon;
use App\Mail\Sendmail;

class MomoController extends Controller
{

    public function checkDiscountCode(Request $request)
    {
        $code = $request->code;
        $check = DB::table('nb_discount_code')->where('code', $code)->where('status', 0)->first();
        if($check) {
            $data = ['status' => 200, 'message' => 'Mã hợp lệ', 'data' => $check->discount];
        }else {
            $data = ['status' => 400, 'message' => 'Mã code không tồn tại hoặc đã được sử dụng', 'data' => null];
        }
        return response()->json($data);
    }

    public function pricing_momo_bank(Request $request){
        function execPostRequest($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }
        $code = $request->code;
        $check = DB::table('nb_discount_code')->where('code', $code)->where('status', 0)->first();
        if($check) {
            if($check->discount == "100") {
                DB::beginTransaction();
                try {
                    DB::table('nb_joblists')->where('id', $request->idJob)->update(['status' => 1]);
                    DB::table('nb_discount_code')->where('code', $code)->update(['status' => 1]);
                    DB::table('nb_history_transactions')->insert([
                        'id_user_payment' => Auth::user()->id,
                        'content' => 'thanh toán gói đăng tin cho id việc: '.$request->idJob,
                        'using_discount' => $code,
                        'price' => 0,
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now()
                    ]);
                    $data = ['status' => 200, 'message' => 'Thanh toán thành công', 'data' => null];
                    return response()->json($data);
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollback();
                    $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
                }
            }else {
                $amount = 10000-(10000*int($check->discount)/100);
            }
        }else {
            $getJob = DB::table('nb_joblists')->where('id', $request->idJob)->first();
            if($getJob) {
                $endpoint = "https://payment.momo.vn/gw_payment/transactionProcessor";
                $partnerCode = "MOMOOMRU20191003";
                $accessKey = "ndQI1iiCLFR3EhIZ";
                $serectkey = "TR5EkmDsdECTZNms1SkoF2Ix4sWNw52u";
                $orderInfo = Auth::user()->id."";
                $returnUrl = "https://netbee.vn/admin/tin-tuyen-dung";
                $notifyurl = "https://netbee.vn/api/pricing_momo_bank_checking";
                $orderid = $request->idJob."";
                $requestId = $code ?? '0';
                $requestType = "payWithMoMoATM";
                $extraData = "merchantName=Netbee";
                $amount = "10000";
                $bankCode = $request->bank;
                $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderid."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
                $signature = hash_hmac("sha256", $rawHash, $serectkey);
                $data =  array('partnerCode' => $partnerCode,
                                'accessKey' => $accessKey,
                                'requestId' => $requestId,
                                'amount' => $amount,
                                'orderId' => $orderid,
                                'orderInfo' => $orderInfo,
                                'returnUrl' => $returnUrl,
                                'notifyUrl' => $notifyurl,
                                'extraData' => $extraData,
                                'bankCode' => $bankCode,
                                'requestType' => $requestType,
                                'signature' => $signature);
                $result = execPostRequest($endpoint, json_encode($data));
                $jsonResult =json_decode($result,true);
                $data = ['status' => 200, 'message' => 'Thanh toán thành công', 'data' => $jsonResult['payUrl']];
                return response()->json($data);
            } else {
                $data = ['status' => 200, 'message' => 'Việc làm không còn tồn tại', 'data' => null];
                return response()->json($data);
            }
        }
    }
        
    public function pricing_momo_bank_checking(Request $request){
        function execPostRequestCheck($url, $data)
        {
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
            );
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            //execute post
            $result = curl_exec($ch);
            //close connection
            curl_close($ch);
            return $result;
        }
        $endpoint = "https://payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = $request->partnerCode;
        $accessKey = $request->accessKey;
        $orderid = $request->orderId;
        $serectkey = "TR5EkmDsdECTZNms1SkoF2Ix4sWNw52u";
        $requestId = $request->requestId;
        $requestType = "transactionStatus";
        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&orderId=".$orderid."&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $serectkey);
        $data =  array('partnerCode' => $partnerCode,
                        'accessKey' => $accessKey,
                        'requestId' => $requestId,
                        'orderId' => $orderid,
                        'requestType' => $requestType,
                        'signature' => $signature);
        $result = execPostRequestCheck($endpoint, json_encode($data));
        $jsonResult =json_decode($result,true);  // decode json
        if($jsonResult['errorCode'] == 0 ){
            DB::table('nb_joblists')->where('id', $orderid)->update(['status' => 1]);
            DB::table('nb_history_transactions')->insert([
                'id_user_payment' => $requestId,
                'content' => 'thanh toán gói đăng tin cho id việc: '.$orderid,
                'using_discount' => $request->orderInfo,
                'price' => $jsonResult['amount'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }else{
            $msg = $jsonResult;
        }
        return response()->json($msg);
    }

}