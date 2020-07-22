<?php
namespace App\Services;

use App\Models\NbJobSave;
use App\Models\NbJoblist;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class SaveService extends BaseService {

    protected $nbJobSave;

    public function __construct(NbJobSave $nbJobSave, NbJoblist $nbJoblist)
    {
        $this->nbJobSave = $nbJobSave;
        $this->nbJoblist = $nbJoblist;
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
    
    public function getSaveBySaver($request)
    {
        $userId = Auth::user()->id;
        $perPage = 6;
        $search = $request->search;
        $searchCategory = $request->searchCategory;
        // $searchAddress = $data->searchAddress;
        $conditions =[];

        if($searchCategory != ''){
            $conditions[] = [
                'type',
                '=',
                $searchCategory
            ];
        }
        
        // if($searchAddress != null){
        //     $conditions[] = [
        //         'nb_joblists.nation_id', '=', $searchAddress
        //     ];
        // }

        $query = $this->nbJoblist
        ->join('nb_job_saves','nb_job_saves.id_job','=','nb_joblists.id')
        ->where('id_saver', Auth::user()->id)
        ->select('nb_joblists.*')
        ->orderBy('nb_job_saves.id', 'DESC')
        ->with('nbJobSave')
        ->with('user')
        ->with('nation');

        if (!empty($conditions)) {
            $query->where($conditions);
        }
        if ($search != '') {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%'.$search.'%');
            });
        }

        return $query->paginate($perPage);

    }

    public function deleteJobSave($id){
        try {
            $job = $this->getSaveByJobId($id)->first();
            if($job) {
                $job->delete();
                return [
                    'status'=> 200,
                    'message' => 'Bỏ lưu thành công',
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Việc làm không tồn tại',
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
            ];
        }
    }
}
