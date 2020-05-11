<?php
namespace App\Services;

use App\Models\Nation;
use Auth;

class HomeService extends BaseService {

    protected $nation;

    public function __construct(Nation $nation)
    {
        $this->nation = $nation;
    }

    public function getNation()
    {
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $this->nation->get()
        ];
    }
}
