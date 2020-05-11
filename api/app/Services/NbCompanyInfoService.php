<?php
namespace App\Services;

use App\Models\NbCompanyInfo;
use JWTAuth;
use function foo\func;

class NbCompanyInfoService extends BaseService {

    protected $nbCompanyInfo;

    public function __construct(NbCompanyInfo $nbCompanyInfo)
    {
        $this->nbCompanyInfo = $nbCompanyInfo;
    }
    public function getInfoAll(){
        $datas = $this->nbCompanyInfo
            ->with(['companyFeedback','user'])
            ->whereHas('user',function($query){
                $query->select('name');
            })
            ->paginate(6);
        foreach($datas as $key=>$data){
            $datas[$key]['rate'] = $this->getRate($data->companyFeedback);
        }
        if($datas){
            $data = ['status' => 200, 'message' => 'Thành công', 'data' => $datas];
        }
        return $data;
    }
    private function getRate($feedBacks)
    {
        $rates = $feedBacks->pluck('rate_feed')->toArray();
        if (empty($rates)) {
            return 0;
        }
        return array_sum($rates)/count($rates);
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
}
