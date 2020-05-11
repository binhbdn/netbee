<?php
namespace App\Services;

use App\Models\Apply;
use App\Models\NbJoblist;
use Auth;

class ApplyJobService extends BaseService {
    
    const   CHO_DUYET = 1,
            ADMIN_DUYET_CV = 2,
            DA_TUYEN = 3,
            TU_CHOI = 4,
            ADMIN_DUYET_HO_SO = 5,
            NTD_DUYET_HO_SO = 6;
            
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
        } else if ($userRole == self::ROLE_COMPANY) {
            $data = $this->getApplyCompany($status);
        }
        return $data;
    }

    public function changeStatusApply($id, $status){
        return Apply::where('id',$id)->update(['status'=>$status]);
    }

    public function refuse($id, $status, $refuse){
        return Apply::where('id',$id)->update(['status' => $status ,'reason_for_rejection' => $refuse]);
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
        return Apply::select('nb_applies.*','users.name as name_company', 'nb_joblists.currency', 'nb_joblists.bonus', 'nb_joblists.time_bonus', 'nb_joblists.title')
                    ->Join('nb_joblists', 'nb_applies.job_id','=','nb_joblists.id')
                    ->Join('users', 'nb_joblists.id_created', '=', 'users.id')
                    ->where($condition)->get();
    }
    public function getApplyHr($status){
        $condition = [];
        if($status){
            $condition = ['nb_applies.status'=>$status];
        }
        return Apply::select('nb_applies.*','users.name as name_company', 'nb_joblists.currency', 'nb_joblists.title')
                    ->Join('nb_joblists', 'nb_applies.job_id','=','nb_joblists.id')
                    ->Join('users', 'nb_joblists.id_created', '=', 'users.id')
                    ->where($condition)
                    ->where('nb_applies.user_create' ,Auth::user()->id)
                    ->get();
    }
    public function getApplyCompany($status){
        $condition = [];
        if($status){
            $condition = ['nb_applies.status'=>$status];
        }
        return Apply::select('nb_applies.*','users.name as name_company', 'nb_joblists.currency', 'nb_joblists.bonus', 'nb_joblists.time_bonus', 'nb_joblists.title')
                    ->Join('nb_joblists', 'nb_applies.job_id','=','nb_joblists.id')
                    ->Join('users', 'nb_joblists.id_created', '=', 'users.id')
                    ->where($condition)
                    ->where('nb_joblists.id_created' ,Auth::user()->id)
                    ->get();

    public function getBonus($id){
        return NbJoblist::where('id', $id)->first()->bonus;
    }
}
