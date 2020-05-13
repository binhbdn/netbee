<?php
namespace App\Services;

use App\Models\NbJobSave;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class SaveService extends BaseService {

    protected $nbJobSave;

    public function __construct(NbJobSave $nbJobSave)
    {
        $this->nbJobSave = $nbJobSave;
    }

    public function getSaveByJobId($jobId)
    {
        $userId = Auth::user()->id;
        return $this->nbJobSave->whereIdJob($jobId)->whereIdSaver($userId);
    }

    public function getSave($jobId)
    {
        $saveExists = $this->getSaveByJobId($jobId)->exists();
        if($saveExists)
        {
            return [
                'status' => 200,
                'message' => 'Thành công',
                'data' => true
            ];
        }
        return [
            'status' => 200,
            'message' => 'Thành công',
            'data' => false
        ];
    }

    public function postSave($jobId)
    {
        if(in_array(Auth::user()->role, [self::ROLE_ADMIN, self::ROLE_COMPANY])) {
            return [
                'status'=> 400,
                'message' => 'Chức năng này chỉ dành cho ứng viên',
                'data' => null
            ];
        }
        $job = $this->getSaveByJobId($jobId);
        if ($job->exists()) {
            try {
                $job->delete();
                return [
                    'status' => 200,
                    'message' => 'Bỏ lưu thành công',
                    'data' => false
                ];
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }
        try {
            $insert = [
                'id_job' => $jobId,
                'id_saver' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $this->nbJobSave->insert($insert);
            return [
                'status' => 200,
                'message' => 'Lưu thành công',
                'data' => true
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
