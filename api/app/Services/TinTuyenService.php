<?php
namespace App\Services;

use App\Models\NbJoblist;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;
use Validator;

class TinTuyenService extends BaseService {

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

    public function store($request)
    {
        $validate = $this->jobRequest($request);
        if ($validate) {
            return $validate;
        }
        $data = $this->getOnlyRequest($request);
        try {
            $this->nbJobList->insert($data);
            return [
                'status' => 200,
                'message' => 'Tạo tin thành công',
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

    public function updateJob($request)
    {
        $jobExists = $this->getJobById($request->id)->whereDeleted(self::ACTIVE)->exists();
        if ($jobExists) {
            return [
                'status'=> 400,
                'message' => 'Tin đã bị xóa',
                'data' => null
            ];
        }
        $validate = $this->jobRequest($request);
        if ($validate) {
            return $validate;
        }
        $data = $this->getOnlyRequest($request);
        try {
            $this->getJobById($request->id)->update($data);
            return [
                'status' => 200,
                'message' => 'Cập nhật tin thành công',
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

    private function jobRequest($request)
    {
        $rules = [
            'title' => 'required',
            'address' => 'required',
            'nation' => 'required',
            'expiration_date' => 'required',
            'description' => 'required',
            'request' => 'required',
            'cv_content' => 'required',
            'benefit' => 'required',
            'age_start' => 'required',
            'age_late' => 'required',
            'quantity' => 'required',
            'subsidy' => 'required',
            'currency' => "required",
            'date_start' => 'required',
            'date_test' => 'required',
            'expected_date' => 'required',
            'salary_start' => 'required',
            'salary_end' => 'required',
        ];
        $messages = [
            'required' => 'Vui lòng nhập đầy đủ thông tin của tin tuyển dụng!',
        ];

        if ($request->type == self::JOB_OVERSEAS_STUDENT) {
            $rules['school_name'] = 'required';
        } else {
            $rules['visa'] = 'required';
            $rules['form_work'] = 'required';
        }

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return [
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ];
        }
        return false;
    }

    private function getOnlyRequest($request)
    {
        $response = [
            'title' => $request->title,
            'workplace' => $request->address,
            'nation_id' => $request->nation,
            'expiration_date' => $request->expiration_date,
            'description' => $request->description,
            'request' => $request->get('request'),
            'cv_content' => $request->cv_content,
            'benefit' => $request->benefit,
            'age_start' => $request->age_start,
            'age_late' => $request->age_late,
            'quantity' => $request->quantity,
            'salary_start' => $request->salary_start,
            'salary_end' => $request->salary_end,
            'subsidy' => $request->subsidy,
            'currency' => $request->currency,
            'date_start' => $request->date_start,
            'date_test' => $request->date_test,
            'expected_date' => $request->expected_date,
            'time_bonus' => $request->time_bonus,
            'bonus' => $request->bonus,
            'highlight_job' => $request->highlight_job,
            'type' => $request->type,
            'id_created' => Auth::user()->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'school_name' => $request->school_name
        ];

        if ($request->type != self::JOB_OVERSEAS_STUDENT) {
            $response['work_form'] = $request->work_form;
            $response['id_visa'] = $request->id_visa;
        }

        return $response;
    }

    public function show($id)
    {
        try{
            $job = $this->getJobById($id)->first();
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $job
            ];
        } catch (\Exception $e){
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
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
                $query = $this->getJobByRoleCompany();
            } else if ($userRole == UserService::ROLE_ADMIN) {
                $query = $this->getJobByRoleAdmin();
            } else {
                $query = $this->getJobByRoleOther();
            }
            $data = [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $query->paginate($perPage)
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

    private function getJobValid()
    {
        return $this->nbJobList->with(['user' => function ($q) {
                $q->select('id', 'name', 'avatar');
            }])
            ->with(['nbCompany' => function ($q) {
                $q->select('id', 'username','company_id');
            }])
            ->with(['nation' => function ($q) {
                $q->select('id', 'name');
            }])
            ->whereHas('user', function ($query) {
                $query->where([
                    'block' => self::UN_BLOCK,
                    'status' => self::ACTIVE
                ]);
            })
            ->where('deleted',self::INACTIVE)
            ->where('status',self::ACTIVE);
    }

    private function getJobByRoleCompany()
    {
        return $this->nbJobList->leftJoin('nb_job_views','nb_job_views.id_job','=','nb_joblists.id')
            ->leftJoin('nb_applies', 'nb_applies.job_id', '=', 'nb_joblists.id')
            ->where('nb_joblists.id_created', Auth::user()->id)
            ->where('nb_joblists.deleted', self::INACTIVE)
            ->orderBy('nb_joblists.id', 'DESC')
            ->select('nb_joblists.*',DB::raw('count(nb_job_views.id_job) as viewers, count(nb_applies.job_id) as applyers'))
            ->groupBy('nb_joblists.id');
    }

    private function getJobByRoleAdmin()
    {
        return $this->nbJobList->where('nb_joblists.deleted', self::INACTIVE)
            ->leftJoin('nb_applies', 'nb_applies.job_id', '=', 'nb_joblists.id')
            ->leftJoin('nb_job_views','nb_job_views.id_job','=','nb_joblists.id')
            ->orderBy('nb_joblists.id', 'DESC')
            ->select('nb_joblists.*',DB::raw('count(nb_job_views.id_job) as viewers, count(nb_applies.job_id) as applyers'))
            ->groupBy('nb_joblists.id');
    }

    private function getJobByRoleOther()
    {

        return $this->getJobValid()->orderBy('highlight_job',  'DESC')->orderBy('id', 'DESC');
    }

    // private function getJobWithConditionAndNotRoleCompany()
    // {
    //     return $this->nbJobList->with(['user' => function ($q) {
    //                     $q->select('id', 'name', 'avatar');
    //                 }])
    //                 ->with(['nation' => function ($q) {
    //                     $q->select('id', 'name');
    //                 }])
    //                 ->whereHas('user', function ($query) {
    //                     $query->where([
    //                         'block' => self::UN_BLOCK,
    //                         'status' => self::ACTIVE
    //                     ]);
    //                 })
    //                 ->orderBy('highlight_job', 'DESC')
    //                 ->orderBy('id', 'DESC');
    // }

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
        $userRole = Auth::user()->role;
        $conditions = [];
        $search = $data->search;
        $searchTitle = $data->searchTitle;
        $searchCategory = $data->searchCategory;
        $searchStatus = $data->searchStatus;

        if ($searchTitle != '') {
            $conditions[] = [
                'nb_joblists.title',
                'LIKE',
                '%'.$searchTitle.'%'
            ];
        }

        if($searchStatus != null){
            $conditions[] = [
                'nb_joblists.title', '=', $searchStatus
            ];
        }

        if($searchCategory != null){
            $conditions[] = [
                'nb_joblists.type','=', $searchCategory
            ];
        }

        if (empty($conditions) && $search == '') {
            $perPage = 6;
            if ($userRole == self::ROLE_COMPANY) {
                $query = $this->getJobByRoleCompany();
            } else if ($userRole == self::ROLE_ADMIN) {
                $query = $this->getJobByRoleAdmin();
            } else {
                $query = $this->getJobByRoleOther();
            }
            return $query->paginate($perPage);
        }

        if ($userRole == self::ROLE_COMPANY) {
            $perPage = 10;
            $query = $this->getJobByRoleCompany();
        } else {
            $perPage = 6;
            $query = $this->getJobValid()
                    ->orderBy('highlight_job', 'DESC')
                    ->orderBy('id', 'DESC');
        }

        if (!empty($conditions)) {
            $query->where($conditions);
        }

        if ($search != '') {
            $query->where(function($q) use ($search){
                $q->where('title', 'LIKE', '%'.$search.'%')
                    ->orwhere('id','LIKE', '%'.$search.'%');
            });
        }
        return $query->paginate($perPage);
    }

    public function getTinTuyenDungNews($type, $limit){
        $query = $this->getJobValid()->where('isPublic',self::ACTIVE);

        if (!empty($type)) {
            $query->where('type', $type);
        }
        if (!empty($limit)) {
            $query->limit($limit);
        }

        $news = $query->orderBy('id', 'desc')->get();
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => [
                'tintuyendung' => $news
            ]
        ];
    }

    public function getNewsHot($limit)
    {
        $query = $this->getJobValid()
            ->where('isPublic',self::ACTIVE)
            ->where('highlight_job',self::ACTIVE);

        if (!empty($limit)) {
            $query->limit($limit);
        }

        $news = $query->orderBy('id', 'desc')->get();
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => [
                'tintuyendung' => $news
            ]
        ];
    }

    public function getTinTuyenDungNewCarousel($isHot = false)
    {
        $perPage = $isHot ? 16 : 8;
        $query = $this->getJobValid()->where('isPublic',self::ACTIVE);
        if ($isHot) {
            $query->whereIn('highlight_job', [self::NEW_HOT, self::NEW_VIP]);
        }
        $response = $query->orderBy('id','desc')->paginate($perPage);
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => [
                'tintuyendung' => $response
            ]
        ];
    }

    public function getTinTuyenDungForCompany($request)
    {
        $id = $request->id;
//        $datas['tintuyendung'] = DB::select('CALL GetTinTuyenDungForCompany('.$request->id.','.$request->limit.')');
//        $datas['count'] = DB::select('CALL GetTinTuyenDungForCompany('.$request->id.',0)');
        return
            [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => [
                    'tintuyendung' => $this->getForCompany($id, $request->limit),
                    'count' => $this->getForCompany($id, 0),
                ]
            ];
    }

    private function getForCompany($id, $limit)
    {
        $query = $this->getJobValid()
            ->where('isPublic',self::ACTIVE)
            ->where('id_created', $id);
        if (!empty($limit)) {
            $query->limit($limit);
        }
        return $query->orderBy('id','desc')->get();
    }

    public function getDetailNew($id)
    {
        $response = $this->nbJobList->with(['user', 'nation'])
            ->where('status',self::ACTIVE)
            ->where('deleted',self::INACTIVE)
            ->where('isPublic',self::ACTIVE)
            ->where('id', $id)
            ->first();
        return [
            'status'=> 200,
            'message' => 'Thành công',
            'data' => $response
        ];
    }
}
