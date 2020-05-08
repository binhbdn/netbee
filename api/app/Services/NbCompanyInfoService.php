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
        if($datas){
            $data = ['status' => 200, 'message' => 'Thành công', 'data' => $datas];
        }
        return $data;
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
