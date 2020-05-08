<?php
namespace App\Services;

use App\Models\Apply;
use App\Models\NbJoblist;
use Auth;

class ApplyJobService extends BaseService {
    
    const   CHO_DUYET = 1, 
            DA_DUYET = 2, 
            DA_TUYEN = 3, 
            TU_CHOI = 4;

    const All = 0;


    public function create($data){
        return Apply::insert($data);
    }

    public function getApply($status)
    {
        $query = Apply::with('Jobs');
        if($status){
            $data = $query->whereStatus($status)->orderby('id','desc')->get();
        } else {
            $data = $query->orderby('id','desc')->get();     
        }
        return $data;
    }

    public function changeStatusApply($id, $status){
        return Apply::where('id',$id)->update(['status'=>$status]);
    }

    public function getDetailApply($id) {
        return Apply::with('Jobs')->where('id', $id)->first();
    }
}
