<?php
namespace App\Services;

use App\Models\NbJobView;
use Carbon\Carbon;
use Auth;

class ViewService extends BaseService {

    protected $nbJobView;

    public function __construct(NbJobView $nbJobView)
    {
        $this->nbJobView = $nbJobView;
    }

    public function getJobById($jobId)
    {
        $userId = Auth::user()->id;
        return $this->nbJobView->whereIdJob($jobId)->whereIdViewer($userId);
    }

    public function postView($jobId)
    {
        $jobExists = $this->getJobById($jobId)->exists();
        if($jobExists) {
            return [
                'status' => 200,
                'message' => 'View thành công',
                'data' => null
            ];
        }
        try {
            $this->nbJobView->insert([
                'id_job' => $jobId,
                'id_viewer' => Auth::user()->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
            return [
                'status' => 200,
                'message' => 'View thành công',
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
