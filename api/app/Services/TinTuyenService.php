<?php
namespace App\Services;

use App\Models\NbJoblist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class TinTuyenService {

    const
        ACTIVE = 1,
        INACTIVE = 0;

    protected $nbJobList;

    public function __construct(NbJoblist $nbJobList)
    {
        $this->nbJobList = $nbJobList;
    }

    public function getJobById($id)
    {
        return $this->nbJobList->whereId($id);
    }

    public function update($data, $id)
    {
        return $this->getJobById($id)->update($data);
    }

    public function destroy($id)
    {
        try {
            $job = $this->getJobById($id)->first();
            if($job) {
                $data = [
                    'deleted' => self::ACTIVE,
                    'updated_at' => Carbon::now()
                ];
                $sortDelete = $this->update($data, $id);

                return [
                    'status'=> 200,
                    'message' => 'Xóa tin thành công',
                    'data' => $sortDelete
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tin không tồn tại',
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

    public function getJobs()
    {
        $userRole = Auth::user()->role;
        $perPage = 6;
        try {
            if ($userRole == UserService::ROLE_COMPANY) {
                $jobs = $this->getJobByRoleCompany($perPage);
            } else if ($userRole == UserService::ROLE_ADMIN) {
                $jobs = $this->getJobByRoleAdmin($perPage);
            } else {
                $jobs = $this->getJobByRoleOther($perPage);
            }
            $data = [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $jobs
            ];
        } catch (\Exception $e) {
            $data = [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
        return $data;
    }

    private function getJobByRoleCompany($perPage)
    {
        return $this->nbJobList->join('nb_job_views','nb_job_views.id_job','=','nb_joblists.id')
            ->where('nb_joblists.id_created', Auth::user()->id)
            ->where('nb_joblists.deleted', self::INACTIVE)
            ->orderBy('nb_joblists.id', 'DESC')
            ->select('nb_joblists.*',DB::raw('count(nb_job_views.id_job) as viewers'))
            ->groupBy('nb_joblists.id')
            ->paginate($perPage);
    }

    private function getJobByRoleAdmin($perPage)
    {
        return $this->nbJobList->where('nb_joblists.deleted', self::INACTIVE)
            ->leftJoin('nb_job_views','nb_job_views.id_job','=','nb_joblists.id')
            ->orderBy('nb_joblists.id', 'DESC')
            ->select('nb_joblists.*',DB::raw('count(nb_job_views.id_job) as viewers'))
            ->groupBy('nb_joblists.id')
            ->paginate($perPage);
    }

    private function getJobByRoleOther($perPage)
    {
        return $this->nbJobList->select('nb_joblists.*', 'users.name', 'users.avatar', DB::raw('nations.name as nation_name'))
            ->where('nb_joblists.deleted', self::INACTIVE)
            ->where('nb_joblists.status', 1)
            ->Join('users','users.id','=','nb_joblists.id_created')
            ->join('nations', 'nb_joblists.nation_id', '=', 'nations.id')
            ->orderBy('nb_joblists.highlight_job', 'nb_joblists.created_at', 'DESC')
            ->groupBy('nb_joblists.id')
            ->paginate($perPage);
    }

    public function changeStatusJob($id)
    {
        try {
            $job = $this->getJobById($id)->first();
            if($job) {
                $data = [
                    'status' => !$job->status,
                    'updated_at' => Carbon::now()
                ];
                $update = $this->update($data, $id);
                return [
                    'status'=> 200,
                    'message' => 'Thay đổi trạng thái thành công',
                    'data' => $update
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tin không tồn tại',
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

    public function changeStatusJobs($data)
    {
        if(empty($data->id)){
            return [
                'status'=> 400,
                'message' => 'Bạn chưa chọn tin!',
                'data' => null
            ];
        }
        $ids = json_decode($data->id);
        $status = $data->status;
        try {
            $this->nbJobList->whereIn('id', $ids)->update([
                'status' => $status
            ]);
            $message = $status ? 'Kích hoạt thành công' : 'Bỏ kích hoạt thành công';
            return [
                'status'=> 200,
                'message' => $message,
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

    public function destroyJobs($id)
    {
        if(empty($id)){
            return [
                'status'=> 400,
                'message' => 'Bạn chưa chọn tin!',
                'data' => null
            ];
        }
        $ids = json_decode($id);
        try {
            $update = [
                'deleted' => self::ACTIVE,
                'updated_at' =>  Carbon::now()
            ];
            $this->nbJobList->whereIn('id', $ids)->update($update);
            return [
                'status'=> 200,
                'message' => 'Xóa tin thành công',
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

    public function changePublic($id)
    {
        try{
            $job = $this->getJobById($id)->first();
            if($job){
                $isPublic = !$job->isPublic;
                $update = [
                    'isPublic' => $isPublic,
                    'updated_at' => Carbon::now()
                ];
                $this->update($update, $id);
                $message = $isPublic ? 'Hiện tin thành công' : 'Ẩn tin thành công';
                return [
                    'status'=> 200,
                    'message' => $message,
                    'data' => null
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Tin không tồn tại',
                'data' => null
            ];
        }
        catch (\Exception $e) {
            return [
                'status' => 400,
                'message' => 'Có lỗi xảy ra',
                'data'=>$e->getMessage()
            ];
        }
    }

    public function searchJob($data)
    {

    }
}
