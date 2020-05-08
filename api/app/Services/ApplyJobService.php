<?php
namespace App\Services;

use App\Apply;
use Auth;

class ApplyJobService extends BaseService {
    public function create($data){
        return Apply::insert($data);
    }
}
