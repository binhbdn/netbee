<?php
namespace App\Services;

use App\Models\Apply;
use App\Models\NbJoblist;
use Auth;

class ApplyJobService extends BaseService {

    protected $nbJobList;
    protected $apply;

    public function __construct(NbJoblist $nbJobList, Apply $apply)
    {
        $this->nbJobList = $nbJobList;
        $this->apply = $apply;
    }

    public function create($data)
    {
        return Apply::insert($data);
    }

    public function getApply($status)
    {
        $userRole = Auth::user()->role;
        if ($userRole == self::ROLE_ADMIN) {
            $data = $this->getApplyAdmin($status);
        } else if ($userRole == self::ROLE_COMPANY) {
            $data = $this->getApplyCompany($status);
        } else {
            $data = $this->getApplyHr($status);
        }
        return $data;
    }

    public function changeStatusApply($id, $status)
    {
        $data = [
            'status'=>$status
        ];
        return $this->update($data, $id);
    }

    public function refuse($id, $status, $refuse)
    {
        $data = [
            'status' => $status ,
            'reason_for_rejection' => $refuse
        ];
        return $this->update($data, $id);
    }

    public function isPublic($id, $isPublic)
    {
        $data = [
            'isPublic'=>$isPublic
        ];
        return $this->update($data, $id);
    }

    public function ChooseCalendar($date, $id){
        $data = [
            'interview_schedules'=>$date,
            'status' => 6
        ];
        return $this->update($data, $id);
    }

    private function update($data, $id){
        return $this->apply->where('id',$id)->update($data);
    }

    public function getDetailApply($id) 
    {
        return Apply::with('job')->where('id', $id)->first();
    }

    public function getApplyAdmin($status)
    {
        $condition = [];
        if($status){
            $condition[] = ['nb_applies.status','=',$status];
        }
        return $this->getApplyValid()
                    ->where($condition)->get();
    }

    public function getApplyHr($status)
    {
        $condition = [];
        if($status){
            $condition[] = ['nb_applies.status','=',$status];
        }
        return $this->getApplyValid()
                    ->where($condition)
                    ->where('user_id_submit' ,Auth::user()->id)
                    ->get();
    }
    public function getApplyCompany($status)
    {
        return $this->getApplyValid()
                    ->where('user_id_recever' ,Auth::user()->id)
                    ->where('status' ,self::ADMIN_DUYET_HO_SO)
                    ->orwhere('status', self::NTD_DUYET_HO_SO)
                    ->get();
    }

    private function getApplyValid() {
        return $this->apply->with(['user' => function ($q) {
                                $q->select('id', 'name', 'avatar');
                                $q->where([
                                    'status' => self::ACTIVE,
                                    'block' =>self::UN_BLOCK
                                ]);
                            }])
                            ->with(['job' => function ($q) {
                                $q->select('currency', 'title','id');
                                $q->where([
                                    'deleted' => self::UN_DELETE,
                                    'status' => self::ACTIVE,
                                    'isPublic' =>self::ACTIVE
                                ]);
                            }]);
    }

    public function getBonus($id){
        return NbJoblist::where('id', $id)->first()->bonus;
    }

    public function getIdCreated($id){
        return NbJoblist::where('id', $id)->first()->id_created;
    }

    
}
