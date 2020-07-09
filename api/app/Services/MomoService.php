<?php
namespace App\Services;

use App\Models\NbDiscountCode;
use App\Models\NbHistoryTransaction;
use App\Models\NbJoblist;
use App\User;
use App\Models\NbCompanyInfo;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MomoService extends BaseService {

    protected $nbDiscountCode;
    protected $nbJoblist;
    protected $nbHistoryTransaction;
    protected $user;
    protected $nbCompanyInfo;

    public function __construct(
        NbDiscountCode $nbDiscountCode,
        NbJoblist $nbJoblist,
        NbHistoryTransaction $nbHistoryTransaction,
        User $user,
        NbCompanyInfo $nbCompanyInfo
    ) {
        $this->nbDiscountCode = $nbDiscountCode;
        $this->nbJoblist = $nbJoblist;
        $this->nbHistoryTransaction = $nbHistoryTransaction;
        $this->user = $user;
        $this->nbCompanyInfo = $nbCompanyInfo;
    }

    public function getDiscountCodeByCode($code)
    {
        return $this->nbDiscountCode->whereStatus(self::INACTIVE)->whereCode($code);
    }

    public function checkDiscountCode($code)
    {
        $check = $this->getDiscountCodeByCode($code)->first();
        if($check) {
            return [
                'status' => 200,
                'message' => 'Mã hợp lệ',
                'data' => $check->discount
            ];
        }
        return [
            'status' => 400,
            'message' => 'Mã code không tồn tại hoặc đã được sử dụng',
            'data' => null
        ];
    }

    public function pricing($request, $type)
    {
        $code = $request->code;
        $jobId = $request->idJob;

        $discount = $this->getDiscountCodeByCode($code)->value('discount');
        if ($discount == 100) {
            DB::beginTransaction();
            try {
                $this->nbJoblist->whereId($jobId)->update(['status' => self::ACTIVE]);
                $this->nbDiscountCode->whereCode($code)->update(['status' => self::ACTIVE]);
                $this->nbHistoryTransaction->insert([
                    'id_user_payment' => Auth::user()->id,
                    'content' => 'Thanh toán gói đăng tin cho id việc: '.$jobId,
                    'using_discount' => $code,
                    'price' => self::INACTIVE,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                DB::commit();
                return [
                    'status' => 200,
                    'message' => 'Thanh toán thành công',
                    'data' => null
                ];
            } catch (\Exception $e) {
                DB::rollback();
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }
        $job = $this->nbJoblist->whereId($jobId)->exists();
        if (!$job) {
            return [
                'status' => 200,
                'message' => 'Việc làm không còn tồn tại',
                'data' => null
            ];
        }
        $endPoint = "https://payment.momo.vn/gw_payment/transactionProcessor";
        $secretKey = "TR5EkmDsdECTZNms1SkoF2Ix4sWNw52u";

        $partnerCode = "MOMOOMRU20191003";
        $accessKey = "ndQI1iiCLFR3EhIZ";
        $orderInfo = Auth::user()->id."";
        $returnUrl = "https://netbee.vn/admin/tin-tuyen-dung";
        $notifyUrl = "https://netbee.vn/api/pricing_momo_bank_checking";
        $orderId = time()."";
        $requestId = $code ?? '0';
        $amount = "10000";
        $requestType = $type == self::BANK ? 'payWithMoMoATM' : "captureMoMoWallet";
        $extraData = (string)$jobId;
        if ($type == self::BANK) {
            $bank = $request->bank;
        }

        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=".$partnerCode.
            "&accessKey=".$accessKey.
            "&requestId=".$requestId.
            "&amount=".$amount.
            "&orderId=".$orderId.
            "&orderInfo=".$orderInfo.
            "&returnUrl=".$returnUrl.
            "&notifyUrl=".$notifyUrl.
            "&extraData=".$extraData;
        if ($type == self::BANK) {
            $rawHash .= "&bankCode=".$bank;
        }


        // echo "Raw signature: ".$rawHash."\n";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data =  [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];
        if ($type == self::BANK) {
            $data['bankCode'] = $bank;
        }

        $result = $this->execRequest($endPoint, json_encode($data));
        $jsonResult = json_decode($result,true);
        return [
            'status' => 200,
            'message' => 'Thanh toán thành công',
            'data' => $jsonResult['payUrl']
        ];
    }

    public function checkPricing($request)
    {
        $endPoint = "https://payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = $request->partnerCode;
        $accessKey = $request->accessKey;
        $orderId = $request->orderId;
        $secretKey = "TR5EkmDsdECTZNms1SkoF2Ix4sWNw52u";
        $requestId = $request->requestId;
        $requestType = "transactionStatus";
        $rawHash = "partnerCode=".$partnerCode.
            "&accessKey=".$accessKey.
            "&requestId=".$requestId.
            "&orderId=".$orderId.
            "&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data =  array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'orderId' => $orderId,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execRequest($endPoint, json_encode($data));
        $jsonResult = json_decode($result,true);  // decode json

        if($jsonResult['errorCode'] == 0 ){
            $jobId = $request->extraData;
            $this->nbJoblist->whereId($jobId)->update(['status' => self::ACTIVE]);
            $this->nbHistoryTransaction->insert([
                'id_user_payment' => $requestId,
                'content' => 'Thanh toán gói đăng tin cho id việc: '.$jobId,
                'using_discount' => $request->orderInfo,
                'price' => $jsonResult['amount'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $msg = [];
        }else{
            $msg = $jsonResult;
        }
        return response()->json($msg);
    }

    public function pricing_verify($request, $type)
    {
        $endPoint = "https://payment.momo.vn/gw_payment/transactionProcessor";
        $secretKey = "TR5EkmDsdECTZNms1SkoF2Ix4sWNw52u";

        $partnerCode = "MOMOOMRU20191003";
        $accessKey = "ndQI1iiCLFR3EhIZ";
        $orderInfo = Auth::user()->id."";
        $returnUrl = "https://netbee.vn/".$request->url;
        $notifyUrl = "https://netbee.vn/api/pricing_momo_verify_bank_checking";
        $orderId = time()."";
        $requestId = '0';
        $amount = "50000";
        $requestType = $type == self::BANK ? 'payWithMoMoATM' : "captureMoMoWallet";
        $extraData = (string)$jobId;
        if ($type == self::BANK) {
            $bank = $request->bank;
        }

        //before sign HMAC SHA256 signature
        $rawHash = "partnerCode=".$partnerCode.
            "&accessKey=".$accessKey.
            "&requestId=".$requestId.
            "&amount=".$amount.
            "&orderId=".$orderId.
            "&orderInfo=".$orderInfo.
            "&returnUrl=".$returnUrl.
            "&notifyUrl=".$notifyUrl.
            "&extraData=".$extraData;
        if ($type == self::BANK) {
            $rawHash .= "&bankCode=".$bank;
        }


        // echo "Raw signature: ".$rawHash."\n";
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data =  [
            'partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'returnUrl' => $returnUrl,
            'notifyUrl' => $notifyUrl,
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        ];
        if ($type == self::BANK) {
            $data['bankCode'] = $bank;
        }

        $result = $this->execRequest($endPoint, json_encode($data));
        $jsonResult = json_decode($result,true);
        return [
            'status' => 200,
            'message' => 'Thanh toán thành công',
            'data' => $jsonResult['payUrl']
        ];
    }

    public function checkPricingVerify($request)
    {
        $endPoint = "https://payment.momo.vn/gw_payment/transactionProcessor";
        $partnerCode = $request->partnerCode;
        $accessKey = $request->accessKey;
        $orderId = $request->orderId;
        $orderInfo = $request->orderInfo;
        $secretKey = "TR5EkmDsdECTZNms1SkoF2Ix4sWNw52u";
        $requestId = $request->requestId;
        $requestType = "transactionStatus";
        $rawHash = "partnerCode=".$partnerCode.
            "&accessKey=".$accessKey.
            "&requestId=".$requestId.
            "&orderId=".$orderId.
            "&requestType=".$requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data =  array('partnerCode' => $partnerCode,
            'accessKey' => $accessKey,
            'requestId' => $requestId,
            'orderId' => $orderId,
            'requestType' => $requestType,
            'signature' => $signature);
        $result = $this->execRequest($endPoint, json_encode($data));
        $jsonResult = json_decode($result,true);  // decode json

        if($jsonResult['errorCode'] == 0 ){
            $jobId = $request->extraData;
            $this->nbCompanyInfo->where('company_id', $orderInfo)->update(['company_verify' => self::ACTIVE]);
            $this->nbHistoryTransaction->insert([
                'id_user_payment' => $requestId,
                'content' => 'Thanh toán gói xác thực nhà tuyển dụng '.$orderInfo,
                'using_discount' => $requestId,
                'price' => $jsonResult['amount'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            $msg = [];
        }else{
            $msg = $jsonResult;
        }
        return response()->json($msg);
    }

    private function execRequest($url, $data)
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

}
