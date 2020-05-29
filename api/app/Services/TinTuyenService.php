<?php
namespace App\Services;

use App\Jobs\SendMailJobQueue;
use App\Models\NbJoblist;
use App\User;
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
        $user = User::find('id',$data->id_created);
        try {
            $this->nbJobList->create($data);
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] Tin '. $data->title . ' của bạn đang chờ để được phê duyệt!',
                'content' => 'Chúc mừng tin ' . $data->title . ' của bạn đã được tạo thành công. <br> Chúng tôi sẽ phản hồi yêu cầu phê duyệt trong thời gian sớm nhất.',
                'textButton' => 'Về Netbee',
                'url' => 'https://netbee.vn/dang-nhap'
            ];
            dispatch(new SendMailJobQueue($user->email, $dataEmail));
            $userAdmins = User::where('role',4)->get();
            foreach ($userAdmins as $userAdmin){
                    $dataEmail = (object)[
                        'name' => $userAdmin->name,
                        'title' => '[THÔNG BÁO] Tin '. $data->title . ' cần được phê duyệt!',
                        'content' => 'Tin tuyển dụng ' . $data->title . ' cần được phê duyệt. <br> Đăng nhập Netbee ngay để phê duyệt tin.',
                        'textButton' => 'Về Netbee',
                        'url' => 'https://netbee.vn/dang-nhap'
                    ];
            dispatch(new SendMailJobQueue($userAdmin->email, $dataEmail));
            }
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
        $user = User::find('id',$data->id_created);
        try {
            $this->getJobById($request->id)->update($data);
            $dataEmail = [
                'name' => $user->name,
                'title' => '[THÔNG BÁO] Sửa tin '. $data->title . ' Netbee!',
                'content' => 'Tin ' . $data->title . ' của bạn đã được sửa lúc '.$data->updated_at.' <br> <b>Nếu đây là hành động của bạn,</b> vui lòng bỏ qua email này. <br>
                <b>Nếu đây không phải là hành động của bạn,</b> vui lòng liên hệ đội ngũ hỗ trợ của Netbee để được hỗ trợ.',
                'textButton' => 'Đăng nhập Netbee',
                'url' => 'https://netbee.vn/dang-nhap'
            ];
            dispatch(new SendMailJobQueue($user->email, $dataEmail));
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
            'nation_id' => 'required',
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
            $rules['id_visa'] = 'required';
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
            'nation_id' => $request->nation_id,
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
            'id_created' => $request->has('id_created') ? $request->id_created : Auth::user()->id,
            'school_name' => $request->school_name,
            'status' => self::INACTIVE
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
                $user = User::find('id',$job->id_created);
                $this->sendMailDestroy($user,$job);
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
    public function sendMailDestroy($user,$job){
        $dataEmail = (object)[
            'name' => $user->name,
            'title' => '[THÔNG BÁO] Tin tuyển dụng ' .'"'.$job->title .'"' . ' của bạn đã bị xóa!',
            'content' => 'Tin ' .'"'.$job->title .'"' . ' của bạn đã bị xóa. <br> <br>Nếu cho rằng đây là 1 nhầm lẫn, hãy cho chúng tôi biết.<br> Đăng nhập Netbee ngay để xem chi tiết.',
            'textButton' => 'Đăng nhập Netbee',
            'url' => 'https://netbee.vn/dang-nhap'
        ];
        dispatch(new SendMailJobQueue($user->email, $dataEmail));
        $userAdmins = User::where('role',4)->get();
        foreach ($userAdmins as $userAdmin){
            $userDeleted = Auth::user();
            $dataEmail = (object)[
                'name' => $userAdmin->name,
                'title' => '[THÔNG BÁO] Tin tuyển dụng ' .'"'.$job->title .'"' . ' đã bị xóa!',
                'content' => 'Tin ' .'"'.$job->title .'"' . ' của bạn đã bị xóa bởi admin: '.$userDeleted->name . '<br> <br>Nếu cho rằng đây là 1 nhầm lẫn, hãy cho chúng tôi biết.<br> Đăng nhập Netbee ngay để xem chi tiết.',
                'textButton' => 'Đăng nhập Netbee',
                'url' => 'https://netbee.vn/dang-nhap'
            ];
            dispatch(new SendMailJobQueue($userAdmin->email, $dataEmail));
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
    private function getJobValidForCompany($username)
    {
        return $this->nbJobList
            ->with(['user' => function ($q) {
                $q->select('id', 'name', 'avatar');
            }])
            ->with(['nbCompany' => function ($q) {
                $q->select('id', 'username','company_id');
            }])
            ->whereHas('nbCompany', function ($query) use ($username) {
                $query->where([
                    'username' => $username
                ]);
            })
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
            $user = User::find($job->id_created);
            if($job) {
                $data = [
                    'status' => !$job->status,
                    'updated_at' => Carbon::now()
                ];
                $this->sendEmailChangeStatus($job,$user,$data['status']);
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
    public function sendEmailChangeStatus($job,$user,$status){
        $dataEmail = [];
        if($status == 1){
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] Tin tuyển dụng ' .'"'.$job->title .'"' . ' của bạn đã được kích hoạt thành công!',
                'content' => 'Chúc mừng tin' .'"'.$job->title .'"' . ' của bạn đã được kích hoạt thành công. <br> Đăng nhập Netbee ngay để theo dõi chi tiết tin tuyển dụng của mình.',
                'textButton' => 'Đăng nhập Netbee',
                'url' => 'https://netbee.vn/dang-nhap'
            ];
        }
        else{
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] Tin tuyển dụng ' .'"'.$job->title .'"' . ' của bạn đã bị hủy kích hoạt!',
                'content' => 'Chúng tôi đã hủy kích hoạt tin ' .'"'.$job->title .'"' . '. <br>Nếu cho rằng đây là 1 nhầm lẫn, hãy cho chúng tôi biết.<br> Đăng nhập Netbee ngay để xem chi tiết.',
                'textButton' => 'Đăng nhập Netbee',
                'url' => 'https://netbee.vn/dang-nhap'
            ];
        }
        dispatch(new SendMailJobQueue($user->email, $dataEmail));
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
            foreach ($ids as $id){
                $job = $this->nbJobList->find($id);
                $user = User::find($job->id_created);
                $this->sendEmailChangeStatus($job,$user,$status);
            }
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
            foreach ($ids as $id){
                $job = $this->nbJobList->whereId($id)->first();
                $user = User::find($job->id_created);
                $this->sendMailDestroy($user, $job);
            }
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
        $perPage = $isHot ? 20 : 10;
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
        $username = $request->id;
//        $datas['tintuyendung'] = DB::select('CALL GetTinTuyenDungForCompany('.$request->id.','.$request->limit.')');
//        $datas['count'] = DB::select('CALL GetTinTuyenDungForCompany('.$request->id.',0)');
        return
            [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => [
                    'tintuyendung' => $this->getForCompany($username, $request->limit),
                    'count' => $this->getForCompany($username, 0),
                ]
            ];
    }

    private function getForCompany($username, $limit)
    {
        $query = $this->getJobValidForCompany($username)
            ->where('isPublic',self::ACTIVE);
        if (!empty($limit)) {
            $query->limit($limit);
        }
        return $query->orderBy('id','desc')->get();
    }

    public function getDetailNew($id)
    {
        $response = $this->nbJobList->with(['user', 'nation','visa_profession','nbCompany'])
            // ->where('status',self::ACTIVE)
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
