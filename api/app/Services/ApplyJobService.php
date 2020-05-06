<?php
namespace App\Services;

use App\Apply;
use Auth;

class ApplyJobService {
    public function create($data){
        return Apply::insert($data);
    }
}