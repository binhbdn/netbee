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


    public function __construct(ProfileUser $profileUser)
    {
        $this->profileUser = $profileUser;      
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
            return $this->getAllProfile()->get();
        }else if($role == self::HR || $role == self::COMPANY || $role == self::USER){
            return $this->getAllProfileByRole($role)->get();
        }       
    }    

}
