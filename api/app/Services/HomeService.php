<?php
namespace App\Services;

use App\Models\Nation;
use App\Models\VisaProfession;
use Auth;

class HomeService extends BaseService {

    protected $nation;
    protected $visaProfession;

    public function __construct(Nation $nation, VisaProfession $visaProfession)
    {
        $this->nation = $nation;
        $this->visaProfession = $visaProfession;
    }

    public function getNation()
    {
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $this->nation->get()
        ];
    }

    public function getTopNation(){
        try {
            $nation = $this->nation->get();
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $nation
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function getTopVisa(){
        try {
            $visaProfession = $this->visaProfession->get();
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $visaProfession
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
