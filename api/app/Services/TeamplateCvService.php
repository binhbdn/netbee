<?php
namespace App\Services;

use App\Models\ProfileUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class TeamplateCvService {
          

    protected $profileUser;   

    public function __construct(ProfileUser $profileUser)
    {
        $this->profileUser = $profileUser;      
    }

    public function getProfileById($id)
    {
        return $this->profileUser->whereId($id);
    }    

}
