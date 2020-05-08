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
        $data = $this->nbCompanyInfo
            ->with(['companyFeedback'])
            ->with(['user' => function($q) {
                $q->select('name');
            }])
            ->paginate(6);
        dd($data);
        return response()->json($data);
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
