<?php
namespace App\Services;

use App\Models\NbJobReport;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\DB;

class ReportService extends BaseService {

    protected $nbJobReport;

    public function __construct(NbJobReport $nbJobReport)
    {
        $this->nbJobReport = $nbJobReport;
    }

    public function store($data)
    {
        try {
            $insert = [
                'id_job' => $data->id_job,
                'id_reporter' => Auth::user()->id,
                'content' => $data->report,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $this->nbJobReport->insert($insert);
            return [
                'status' => 200,
                'message' => 'Gửi cảnh báo thành công',
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
