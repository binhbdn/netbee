<?php
namespace App\Services;

use App\Models\NbCompanyFeedback;
use App\Models\NbCompanyFollows;
use App\Models\NbCompanyInfo;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use function foo\func;

class NbCompanyInfoService extends BaseService {

    protected $nbCompanyInfo;
    protected $nbCompanyFeedback;
    protected $user;
    protected $nbCompanyFollows;

    public function __construct(NbCompanyInfo $nbCompanyInfo, NbCompanyFeedback $companyFeedback, User $user, NbCompanyFollows $companyFollows)
    {
        $this->nbCompanyInfo = $nbCompanyInfo;
        $this->nbCompanyFeedback = $companyFeedback;
        $this->user = $user;
        $this->nbCompanyFollows = $companyFollows;
    }
    public function getListCompany(){
        $datas = $this->nbCompanyInfo
        ->with(['user'=> function($q){
            $q->select('id','name')->whereStatus(1)->whereBlock(0);
        }])
        ->with(['companyFeedback'=> function($q){
            $q->select('company_id', 'rate_feed');
        }])
        ->select('id','company_id','company_about','username')
        ->paginate(6);
        foreach($datas as $key=>$data){
            $datas[$key]['rate'] = $this->getRate($data->companyFeedback);
        }
        return [
            'status' => 200,
            'message' => 'Thành công',
            'data' => $datas
        ];
    }

    public function getDetailCompanyById($username){
        $datas = $this->user->with('companyFeedback')
            ->with('nbCompany')
            ->whereHas('nbCompany', function ($query) use ($username) {
                $query->where([
                    'username' => $username,
                ]);
            })
        ->whereHas('companyFeedback', function($q){
            $q->where('approve_feed', self::ACTIVE);
        })
            ->where('block', self::UN_BLOCK)
            ->where('status', self::ACTIVE)
        ->first();
        foreach($datas->companyFeedback as $key=>$data){
            $datas['rate'] = $this->getRate($data);
        }
        return [
            'status' => 200,
            'message' => 'Thành công',
            'data' => $datas
        ];
    }
    public function postCompanyFeedback($request){
        if(Auth::check()){
            $user = Auth::user();
            $data = $this->getOnlyData($request,$user);
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
}
