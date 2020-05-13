<?php
namespace App\Services;

use App\Models\ProfileUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class TeamplateCvService {
          

    protected $profileUser; 
    const
        ADMIN = 4,
        HR = 3,
        COMPANY =2,
        USER =1;  
    const
        ACTION = 0,
        NOACTION = 1;

    public function __construct(ProfileUser $profileUser)
    {
        $this->profileUser = $profileUser;      
    }

    public function getProfileById($id)
    {
        return $this->profileUser->whereId($id);
    }

    public function update($data, $id)
    {
        return $this->getProfileById($id)->update($data);
    }

    public function getProfileId($id)
    {
        return $this->getProfileById($id)->first();
    }

    public function getAllProfile(){
        return $this->profileUser;
    }

    public function getAllProfileByRole($role){
        return $this->profileUser->where('id_user','=',$role);
    }

    public function getProfileBy()
    {
        $role = Auth::user()->role;
        if($role == self::ADMIN){
            return $this->getAllProfile()->where('deleted','=',self::ACTION)->get();
        }else if($role == self::HR || $role == self::COMPANY || $role == self::USER){
            return $this->getAllProfileByRole($role)->where('deleted','=',self::ACTION)->get();
        }       
    }  
        
    public function updateProfile($data, $userId)
    {
        return $this->profileUser->whereId($userId)->update($data);
    }

    public function destroy($id)
    {
        try {
            $job = $this->getProfileById($id)->first();
            if($job) {
                $data = [
                    'deleted' => self::NOACTION,
                    'updated_at' => Carbon::now()
                ];
                $sortDelete = $this->update($data, $id);

                return [
                    'status'=> 200,
                    'message' => 'Xóa hồ sơ thành công',
                    'data' => $sortDelete
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Hồ sơ không tồn tại',
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

}
