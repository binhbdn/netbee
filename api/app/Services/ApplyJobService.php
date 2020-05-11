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

    const AN = 0,
          HIEN = 1;

    public function create($data){
        return Apply::insert($data);
    }

    public function getApply($status)
    {
        $userRole = Auth::user()->role;
        if ($userRole == self::ROLE_ADMIN) {
            $data = $this->getApplyAdmin($status);
        } else if ($userRole == self::ROLE_HR) {
            $data = $this->getApplyHr($status);
        } //else {
        //     $query = $this->getJobByRoleOther();
        // }
        return $data;
    }

    public function changeStatusApply($id, $status){
        return Apply::where('id',$id)->update(['status'=>$status]);
    }

    public function getDetailApply($id) {
        return Apply::with('Jobs')->where('id', $id)->first();
    }

    public function isPublic($id, $isPublic){
        return Apply::where('id',$id)->update(['isPublic'=>$isPublic]);
    }

    public function getApplyAdmin($status){
        $condition = [];
        if($status){
            $condition = ['nb_applies.status'=>$status];
        }
        return Apply::select('nb_applies.*','users.name as name_company', 'nb_joblists.title')
                    ->Join('nb_joblists', 'nb_applies.job_id','=','nb_joblists.id')
                    ->Join('users', 'nb_joblists.id_created', '=', 'users.id')
                    ->where($condition)->get();
    }
    public function getApplyHr($status){
        $condition = [];
        if($status){
            $condition = ['nb_applies.status'=>$status];
        }
        return Apply::select('nb_applies.*','users.name as name_company', 'nb_joblists.time_bonus', 'nb_joblists.bonus','nb_joblists.title')
                    ->Join('nb_joblists', 'nb_applies.job_id','=','nb_joblists.id')
                    ->Join('users', 'nb_joblists.id_created', '=', 'users.id')
                    ->where($condition)
                    ->where('nb_applies.user_create' ,Auth::user()->id)
                    ->get();
    }
}
