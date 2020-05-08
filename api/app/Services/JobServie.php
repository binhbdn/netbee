<?php
namespace App\Services;

use App\Models\NbJoblist;

class JobServie {
    const
        ACTIVE = 1,
        INACTIVE = 0;
    const
        BLOCK = 1,
        UN_BLOCK = 0;

    protected $nbJobList;
    public function __construct(NbJoblist $nbJobList)
    {
        $this->nbJobList = $nbJobList;
    }

    public function getJobById($id){
        return $this->nbJobList->whereId($id);
    }

    public function update($id,$data){
        return $this->getJobByID($id)->update($data);
    }

    public function getTinTuyenDungNews($type, $limit){
        $datas = $this->nbJobList
            ->with(['user', 'nation'])
            ->whereHas('user', function ($query) {
                $query->where([
                    'block' => self::UN_BLOCK,
                    'status' => self::ACTIVE
                ]);
            })
            ->where('deleted',self::INACTIVE)
            ->where('status',1)
            ->where('isPublic',1)
            ->where('type',$type)
            ->orderBy('id','desc')
            ->limit($limit)
            ->get();
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $datas
        ];
    }
}
