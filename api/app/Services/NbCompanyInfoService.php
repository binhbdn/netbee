<?php 
namespace App\Services;

use App\Models\NbCompanyInfo;
use JWTAuth;

class NbCompanyInfoService {
   
    protected $nbCompanyInfo;
    
    public function __construct(NbCompanyInfo $nbCompanyInfo)
    {
        $this->nbCompanyInfo = $nbCompanyInfo;
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