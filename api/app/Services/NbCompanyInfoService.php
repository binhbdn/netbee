<?php
namespace App\Services;

use App\Models\NbCompanyFeedback;
use App\Models\NbCompanyFollows;
use App\Models\NbCompanyInfo;
use App\Models\NbEmailCompany;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use function foo\func;

class NbCompanyInfoService extends BaseService {

    const
        IS_HOT = 1,
        IS_VERIFY = 2,
        IS_NEW = 3,
        COMPANY_VERIFIED = 1,
        COMPANY_UN_VERIFIED = 0,
        UN_LIMIT = 0,
        NO_PAGINATION = 0;

    protected $nbCompanyInfo;
    protected $nbCompanyFeedback;
    protected $user;
    protected $nbCompanyFollows;
    protected $nbEmailCompany;

    public function __construct(NbCompanyInfo $nbCompanyInfo, NbCompanyFeedback $companyFeedback, User $user, NbCompanyFollows $companyFollows, NbEmailCompany $nbEmailCompany)
    {
        $this->nbCompanyInfo = $nbCompanyInfo;
        $this->nbCompanyFeedback = $companyFeedback;
        $this->user = $user;
        $this->nbCompanyFollows = $companyFollows;
        $this->nbEmailCompany = $nbEmailCompany;
    }
    public function getListCompany($type, $limit, $perPage){
        $datas = $this->nbCompanyInfo

        ->with(['user'=> function($q){
            $q->select('id','name','avatar');
        }])
        ->whereHas('user', function ($query) {
            $query->where([
                'block' => self::UN_BLOCK,
                'status' => self::ACTIVE
            ]);
        })
        // ->with(['companyFeedback'=> function($q){
        //     $q->select('company_id', 'rate_feed');
        // }])
        ->select('id','company_id','company_about','username','image_cover','company_verify');
        $getData = null;
        if($perPage == self::NO_PAGINATION){
            if ($type == self::IS_VERIFY){
                $datas->where('company_verify', 1)
                    ->orderBy('id','DESC');
            }
            if ($type == self::IS_NEW){
                $datas->orderBy('id','DESC');
            }
            if($limit != self::UN_LIMIT){
                $datas->orderBy('id','DESC')->limit($limit);
            }
            $getData = $datas->orderBy('id','DESC')->get();
        }
        else{
            $getData = $datas->orderBy('id','DESC')->paginate($perPage);
        }   
        
        foreach($getData as $key=>$data){
            if(isset($data->companyFeedback)){
                $getData[$key]['rate'] = $this->getRate($data->companyFeedback);
            }
        }
        return [
            'status' => 200,
            'message' => 'Thành công',
            'data' => $getData
        ];
    }

    public function getListCompanyUser($type, $limit, $perPage){
        $datas = $this->user
        ->with(['nbCompany'=> function($q){
            $q->select('id','company_id','company_about','username','image_cover','company_verify');
        }])
        ->where('block',self::UN_BLOCK)
        ->where('status',self::ACTIVE)
        ->where('role',2)
        ->orderBy('id','DESC')
        ->select('id','name','avatar');
        $getData = null;
        try {
            $getData = $datas->orderBy('id','DESC')->paginate($perPage);
            foreach($getData as $key=>$data){
                if(isset($data->companyFeedback)){
                    $getData[$key]['rate'] = $this->getRate($data->companyFeedback);
                }
            }
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $getData
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function getDetailCompanyById($username){
        $datas = $this->user->with('companyFeedback')
            ->with('nbCompany')
            ->whereHas('nbCompany', function ($query) use ($username) {
                $query->where([
                    'username' => $username,
                ]);
            })
        // ->whereHas('companyFeedback', function($q){
        //     $q->where('approve_feed', self::ACTIVE);
        // })
            ->where('block', self::UN_BLOCK)
            ->where('status', self::ACTIVE)
        ->first();
        if(isset($datas->companyFeedback)) {
            foreach($datas->companyFeedback as $key=>$data){
                $datas['rate'] = $this->getRate($data);
            }
        }
        return [
            'status' => 200,
            'message' => 'Thành công',
            'data' => $datas
        ];
    }

    public function postVerifyByAdmin($request){
        $company_info = $this->nbCompanyInfo->where('company_id', $request['company_id'])->first();
        $data = [
            'company_verify' => self::COMPANY_VERIFIED,
        ];
        if($company_info->company_verify == 0){
            $company_info->update($data);
            return [
                'status' => 200,
                'message' => 'Kích hoạt công ty thành công!',
                'data' =>null
            ];
        }
        else{
            return [
                'status' => 400,
                'message' => 'Lỗi kích hoạt!',
                'data' =>null
            ];
        }
    }

    public function postCompanyFeedback($request){
        if(Auth::check()){
            $user = Auth::user();
            $data = $this->getOnlyData($request,$user);
            if($request['content_feed'] == null || $request['content_feed'] == ' '){
                return [
                    'status' => 400,
                    'message' => 'Bạn chưa nhận xét!',
                    'data' => null
                ];
            }
            else if(strlen($request['content_feed']) < 10){
                return [
                    'status' => 400,
                    'message' => 'Nhận xét phải ít nhất 10 ký tự!',
                    'data' => null
                ];
            }
            else if($request['rate_feed'] == 0){
                return [
                    'status' => 400,
                    'message' => 'Bạn chưa đánh giá!',
                    'data' => null
                ];
            }else{
                try {
                $this->nbCompanyFeedback->insert($data);
                return [
                    'status' => 200,
                    'message' => 'Cám ơn bạn đã phản hồi!',
                    'data' => null
                ];
                } catch (\Exception $e) {
                    return [
                        'status'=> 400,
                        'message' => 'Có lỗi xảy ra',
                        'data' => $e->getMessage()
                    ];
                }
            }
        }else{
            return [
                'status' => 500,
                'message' => 'Bạn chưa đăng nhập!',
                'data' => null
            ];
        }
    }
    private function getOnlyData($request,$user)
    {
        return [
            'company_id' => $request->company_id,
            'avatar_feed' => $user->avatar,
            'name_feed' => $user->name,
            'email_feed' => $user->email,
            'content_feed' => $request->content_feed,
            'rate_feed' => $request->rate_feed,
            'approve_feed' => self::ACTIVE,
            'user_id' => $user->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    public function followCompany($request){
        if(!$request->has('user_id') || !$request->has('username')){
            return [
                'status'=> 200,
                'message'=> 'Dữ liệu không được để trống.',
                'data'=> null
            ];
        }
        $user_id =Auth::user()->id;
        $company_id = $this->nbCompanyInfo->where('username', $request->username)->first()->id;
        $isFollow = $request-> is_follow;
        if($isFollow == 'true'){
            $this->nbCompanyFollows->insert(
                [
                    'user_id' => $user_id,
                    'company_id' => $company_id,
                    'created_at'=> new \DateTime()
                ]
            );
            return [
                'status'=> 200,
                'message'=> 'Thêm thành công.',
                'data'=> null
            ];
        }
        else{
             $this->nbCompanyFollows
                ->where('company_id',$company_id)
                ->where('user_id',$user_id)
                ->first()
             ->delete();
            return [
                'status'=> 200,
                'message'=> 'Xóa thành công.',
                'data'=> null
            ];
        }

    }
    public function checkFollow($request){
            $user_id = Auth::user()->id;
            $company_id = $this->nbCompanyInfo->where('username', $request->username)->first()->id;
            $data = $this->nbCompanyFollows
                ->where('company_id',$company_id)
                ->where('user_id',$user_id)
                ->first();
            if($data){
                return [
                    'status'=> 200,
                    'message'=> 'Đang follow.',
                    'data'=> null
                ];
            }
            else{
                return [
                    'status'=> 400,
                    'message'=> 'Không tìm thấy.',
                    'data'=> null
                ];
            }
    }
    public function countFollow($request){
            $followers = $this->nbCompanyFollows
            ->where('company_id',$this->nbCompanyInfo->where('username', $request->username)->first()->id)
            ->count();
        return [
            'status'=> 200,
            'message'=> 'Thành công.',
            'data'=> $followers
        ];
    }
    private function getRate($feedBacks)
    {
        $rates = $feedBacks->pluck('rate_feed')->toArray();
        return empty($rates) ? 0 : round(array_sum($rates)/count($rates),1);
    }

    public function getInfoByUserId($userId)
    {
        return $this->nbCompanyInfo->whereCompanyId($userId);
    }

    public function store($data)
    {
        return $this->nbCompanyInfo->insert($data);
    }

    public function updateByUserId($data, $userId)
    {
        return $this->nbCompanyInfo->whereCompanyId($userId)->update($data);
    }

    public function checkUsernameCompany($username)
    {
        return $this->nbCompanyInfo->where('username', $username)->exists();
    }
    public function getRating($company_id) 
    {
        $rate_score = $this->nbCompanyFeedback->where('company_id', $company_id)->pluck('rate_feed')->toArray();
        $total_score = empty($rate_score) ? 0 : round(array_sum($rate_score)/count($rate_score), 1);
        return [
            'status'=> 200,
            'message'=> 'Thành công.',
            'total_score'=> $total_score
        ];
    }
    public function getEmailCompany()
    {
        return $this->nbEmailCompany->where('id_company', Auth::user()->id)->get();
    }
    public function postEmailCompany($request)
    {
        if(Auth::check()){
            $data = $this->getOnlyEmailCompanyData($request);
            if($request['email_company'] == null || $request['email_company'] == ''){
                return [
                    'status' => 400,
                    'message' => 'Bạn chưa nhập email!',
                    'data' => null
                ];
            }
            elseif ($request['status'] == null || $request['status'] == '' || $request['status'] == 0) {
                return [
                    'status' => 400,
                    'message' => 'Bạn chưa phân quyền cho email!',
                    'data' => null
                ];
            }
            else{
                try {
                    $this->nbEmailCompany->insert($data);
                    return [
                        'status' => 200,
                        'message' => 'Thêm email thành công!',
                        'data' => null
                    ];
                } catch (\Exception $e) {
                    return [
                        'status'=> 400,
                        'message' => 'Có lỗi xảy ra!',
                        'data' => $e->getMessage()
                    ];
                }
            }
        }else{
            return [
                'status' => 500,
                'message' => 'Bạn chưa đăng nhập!',
                'data' => null
            ];
        }
    }
    public function updateStatus0($request)
    {
        if(Auth::check()){
            $data = $this->getOnlyUpdateEmailCompanyData($request);
                try {
                    $this->nbEmailCompany->where('id', $request->id)->update($data);
                    return [
                        'status' => 200,
                        'message' => 'Thay đổi quyền thành công!',
                        'data' => null
                ];
                } catch (\Exception $e) {
                    return [
                        'status'=> 400,
                        'message' => 'Có lỗi xảy ra!',
                        'data' => $e->getMessage()
                    ];
                }
        }else{
            return [
                'status' => 500,
                'message' => 'Bạn chưa đăng nhập!',
                'data' => null
            ];
        }
    }
    public function updateStatus1($request)
    {
        if(Auth::check()){
            $data = $this->getOnlyUpdateEmailCompanyData($request);
                try {
                    $this->nbEmailCompany->where('id', $request->id)->update($data);
                    return [
                        'status' => 200,
                        'message' => 'Thay đổi quyền thành công!',
                        'data' => null
                ];
                } catch (\Exception $e) {
                    return [
                        'status'=> 400,
                        'message' => 'Có lỗi xảy ra!',
                        'data' => $e->getMessage()
                    ];
                }
        }else{
            return [
                'status' => 500,
                'message' => 'Bạn chưa đăng nhập!',
                'data' => null
            ];
        }
    }
    public function updateStatus2($request)
    {
        if(Auth::check()){
            $data = $this->getOnlyUpdateEmailCompanyData($request);
                try {
                    $this->nbEmailCompany->where('id', $request->id)->update($data);
                    return [
                        'status' => 200,
                        'message' => 'Thay đổi quyền thành công!',
                        'data' => null
                ];
                } catch (\Exception $e) {
                    return [
                        'status'=> 400,
                        'message' => 'Có lỗi xảy ra!',
                        'data' => $e->getMessage()
                    ];
                }
        }else{
            return [
                'status' => 500,
                'message' => 'Bạn chưa đăng nhập!',
                'data' => null
            ];
        }
    }
    public function suaEmailCompany($request)
    {
        if(Auth::check()){
            $data = $this->getOnlySuaEmailCompanyData($request);
            if($request['email_company'] == null || $request['email_company'] == ''){
                return [
                    'status' => 400,
                    'message' => 'Bạn chưa nhập email!',
                    'data' => null
                ];
            }else{
                try {
                    $this->nbEmailCompany->where('id', $request->id)->update($data);
                    return [
                        'status' => 200,
                        'message' => 'Cập nhật email thành công!',
                        'data' => null
                ];
                } catch (\Exception $e) {
                    return [
                        'status'=> 400,
                        'message' => 'Có lỗi xảy ra!',
                        'data' => $e->getMessage()
                    ];
                }
            }
        }else{
            return [
                'status' => 500,
                'message' => 'Bạn chưa đăng nhập!',
                'data' => null
            ];
        }
    }
    public function postDeleteEmailCompany($request)
    {
        if(Auth::check()){
            $email = $this->nbEmailCompany->whereId($request->id)->first();
            if($email) {
                $email->delete();
                return [
                    'status'=> 200,
                    'message' => 'Xóa thành công!',
                ];
            }else{
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra!',
                ];
            }
        }else{
            return [
                'status' => 500,
                'message' => 'Bạn chưa đăng nhập!',
                'data' => null
            ];
        }
    }
    private function getOnlyEmailCompanyData($request)
    {
        return [
            'id_company' => Auth::user()->id,
            'email_company' =>$request->email_company,
            'status' => $request->status,
            'created_at' => Carbon::now()
        ];
    }
    private function getOnlyUpdateEmailCompanyData($request)
    {
        return [
            'status' => $request->status,
            'updated_at' => Carbon::now()
        ];
    }
    private function getOnlySuaEmailCompanyData($request)
    {
        return [
            'email_company' => $request->email_company,
            'updated_at' => Carbon::now()
        ];
    }
}
