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
        $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = "MOMOD0QE20190401";
        $accessKey = "Ve9eHuGowBUYbZho";
        $serectkey = "8iMg1lTmz3lN3t0xJBrGIYxMACGQaiEC";
        $orderInfo = "pay with MoMo";
        $returnUrl = "https://devwork.vn/admin/index#/pricing/1";
        $notifyurl = "https://devwork.vn/admin/index#/pricing/1";
        $orderid = time()."";
        $requestId = time()."";
        $requestType = "payWithMoMoATM";
        $extraData = "merchantName=Devwork";
        $amount = "10000";
        $bankCode = "VCB";

        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=".$partnerCode."&accessKey=".$accessKey."&requestId=".$requestId."&bankCode=".$bankCode."&amount=".$amount."&orderId=".$orderid."&orderInfo=".$orderInfo."&returnUrl=".$returnUrl."&notifyUrl=".$notifyurl."&extraData=".$extraData."&requestType=".$requestType;
        // echo "Raw signature: ".$rawHash."\n";
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
        //print_r(json_encode($data));
        $result = execPostRequest($endpoint, json_encode($data));
        $jsonResult =json_decode($result,true);  // decode json
        return response()->json($jsonResult['payUrl']);
    }

}