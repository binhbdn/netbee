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

    public function getDetailCompanyById($companyId){
        $datas = $this->user
        ->with(['nbCompany'=> function($q)use ($companyId){
            $q->where('username',$companyId);
        }])
        ->with(['companyFeedback'=> function($q){
            $q->where('approve_feed',self::ACTIVE);
        }])
        ->get();
        foreach($datas as $key=>$data){
            $datas[$key]['rate'] = $this->getRate($data->companyFeedback);
        }
        return [
            'status' => 200,
            'message' => 'Thành công',
            'data' => $datas
        ];
    }
    public function postCompanyFeedback($request){
        $data = $this->getOnlyData($request);
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
    private function getOnlyData($request)
    {

        return [
            'company_id' => $request->company_id,
            'avatar_feed' => $request->avatar_feed,
            'name_feed' => $request->name_feed,
            'email_feed' => $request->email_feed,
            'content_feed' => $request->content_feed,
            'rate_feed' => $request->rate_feed,
            'approve_feed' => self::ACTIVE,
            'user_id' => $request->user_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
    public function followCompany($request){
        if(!$request->has('user_id') || !$request->has('company_id')){
            return [
                'status'=> 200,
                'message'=> 'Dữ liệu không được để trống.',
                'data'=> null
            ];
        }
        $user_id =Auth::user()->id;
        $company_id = $request->company_id;
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
        if($request->has('user_id') && $request->has('company_id')){
            $user_id = Auth::user()->id;
            $company_id = $request->company_id;
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
        else{
            $followers = $this->nbCompanyFollows->where('company_id',$request->company_id)->count();
            return [
                'status'=> 200,
                'message'=> 'Thành công.',
                'data'=> $followers
            ];
        }
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
