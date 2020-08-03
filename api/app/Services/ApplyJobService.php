<?php
namespace App\Services;

use App\Jobs\SendMailJobQueue;
use App\Models\Apply;
use App\Models\NbJoblist;
use App\Models\NbPaper;
use App\Models\NbCreateCall;
use App\Models\NbHistoryCall;
use App\User;
use Auth;
use Validator;
use Carbon\Carbon;

class ApplyJobService extends BaseService {

    const
        ALL = 1,
        CHUAPHEDUYET = 2,
        DAPHEDUYET = 3,
        LICHPHONGVAN = 4,
        HUY = 5;
    protected $nbJobList;
    protected $apply;
    protected $nbPaper;
    protected $nbCreateCall;
    protected $nbHistoryCall;

    public function __construct(NbJoblist $nbJobList, Apply $apply, NbPaper $nbPaper, NbCreateCall $nbCreateCall, NbHistoryCall $nbHistoryCall)
    {
        $this->nbJobList = $nbJobList;
        $this->apply = $apply;
        $this->nbPaper = $nbPaper;
        $this->nbCreateCall = $nbCreateCall;
        $this->nbHistoryCall = $nbHistoryCall;
    }

    public function create($data)
    {
        return Apply::insert($data);
    }

    public function getApply($request,$status)
    {
        $userRole = Auth::user()->role;
        if ($userRole == self::ROLE_ADMIN) {
            $data = $this->getApplyAdmin($request,$status);
        } else if ($userRole == self::ROLE_COMPANY) {
            $data = $this->getApplyCompany();
        } else {
            $data = $this->getApplyHr($status);
        }
        return $data;
    }

    public function changeStatusApply($id, $status)
    {
        $this->sendMailApply($id, $status);
        $data = [
            'status'=>$status
        ];
        return $this->update($data, $id);
    }
    public function sendMailApply($idApply, $type){
        $apply = $this->apply->whereId($idApply)->first();
        $job = $this->nbJobList->where('id',$apply -> job_id)->first();
        $user = User::whereId($apply -> user_id_submit)->first();
        $dataEmail = [];
        $employer =  User::whereId($apply -> user_id_recever)->first();
        $adminUsers = User::where('role', self::ROLE_ADMIN)->get();
        if($type == self::ADMIN_DUYET_CV){
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] CV ứng tuyển '.'"' . $job->title. '"'.' của bạn đã được Netbee phê duyệt.!',
                'content' =>'Chúc mừng CV ứng tuyển '. ' "' . $job->title. '"' .' của bạn đã được bạn quan trị Netbee phê duyệt thành công.<br> <b>Để hoàn thiện hồ sơ bạn cần chuẩn bị những giấy tờ sau:</b><br>1. Chứng minh thư nhân dân 2 mặt. <br> 2. Ảnh chân dung.
                    <br>3. Bằng tốt nghiệp các cấp. <br>4. Giấy khai sinh <br> 5. Sơ yếu lý lịch <br> 6. Giấy khám sức khỏe <br> 7. Hộ chiếu',
                'textButton' => 'Nộp hồ sơ ngay',
                'url' => 'https://netbee.vn/admin/ho-so'
            ];
        }
        else if($type == self::TU_CHOI){
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] CV ứng tuyển '.'"' . $job->title. '"'.' của bạn chưa được Netbee phê duyệt.!',
                'content' =>'CV ứng tuyển '. ' "' . $job->title. '"' .' của bạn đã được bạn chưa được Netbee phê duyệt.<br>Lý do: '.$apply-> reason_for_rejection.' <br> Đăng nhập ngay Netbee để xem thông tin chi tiết.',
                'textButton' => 'Về Netbee',
                'url' => 'https://netbee.vn/admin/ho-so'
            ];
        }
        else if($type == self::ADMIN_DUYET_HO_SO){
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] Phê duyệt hồ sơ ảnh xem xét ứng tuyển '.'"' . $job->title. '"'.' của bạn chưa được Netbee phê duyệt.!',
                'content' =>'Hồ sơ ảnh xem xét ứng tuyển '. ' "' . $job->title. '"' .' của bạn đã được bạn đã được Netbee phê duyệt. <br> Đăng nhập ngay Netbee để xem thông tin chi tiết.',
                'textButton' => 'Đăng nhập Netbee',
                'url' => 'https://netbee.vn/admin/ho-so'
            ];
            $dataEmailToEmployer = (object)[
                'name' => $employer-> name,
                'title' => '[THÔNG BÁO] Có ứng viên mới ứng tuyển '.'"' . $job->title. '"'.'.!',
                'content' =>'Xem chi tiết ứng viên ứng tuyển công việc '. ' "' . $job->title. '"' .'. <br> Đăng nhập ngay Netbee để xem thông tin chi tiết.',
                'textButton' => 'Xem hồ sơ',
                'url' => 'https://netbee.vn/admin/ho-so'
            ];
            dispatch(new sendMailJobQueue($employer->email, $dataEmailToEmployer));
        }
        else if($type == self::CHO_DUYET_HO_SO){
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] Hồ sơ ảnh xem xét ứng tuyển '.'"' . $job->title. '"'.' của bạn đang được xem xét phê duyệt.!',
                'content' =>'Hồ sơ ứng tuyển '. ' "' . $job->title. '"' .' của bạn đã được bạn đang được Netbee xem xét phê duyệt. <br> Đăng nhập ngay Netbee để xem thông tin chi tiết.',
                'textButton' => 'Về Netbee',
                'url' => 'https://netbee.vn/admin/ho-so'
            ];

            foreach ($adminUsers as $adminUser){
                $dataEmailAdmin = (object)[
                    'name' => $adminUser->name,
                    'title' => '[THÔNG BÁO] Hồ sơ ứng tuyển bổ sung '.'"' . $job->title. '"'.' đang cần được phê duyệt.!',
                    'content' =>'Hồ sơ ứng tuyển '. ' "' . $job->title. '"' .' của ứng viên '.' "' . $user->name. '"'.' đang cần được phê duyệt. <br> Đăng nhập ngay Netbee để phê duyệt trong thời gian sớm nhất.',
                    'textButton' => 'Phê duyệt ngay',
                    'url' => 'https://netbee.vn/admin/quan-ly-ung-tuyen'
                ];
                dispatch(new SendMailJobQueue($adminUser->email, $dataEmailAdmin));
            }
        }
        else if($type == self::HEN_LICH_PHONG_VAN){
            $dataEmail = (object)[
                'name' => $user->name,
                'title' => '[THÔNG BÁO] Hẹn lịch phỏng vấn công việc '.'"' . $job->title. '"'.'!',
                'content' =>'Hồ sơ ứng tuyển '. ' "' . $job->title. '"' .' của bạn đã được nhà tuyển dụng '.$employer->name.' xem xét và đánh giá cao. <br>Trân trọng kính mời'
                    .$user->name.' tham gia buổi phỏng vấn online tại <b>"Phòng họp trực tuyến"</b> tại Netbee Đăng nhập ngay Netbee để xem thông tin chi tiết.',
                'textButton' => 'Tham gia họp',
                'url' => 'https://netbee.vn/admin/call'
            ];
        }
        dispatch(new SendMailJobQueue($user->email, $dataEmail));
    }

    public function refuse($id, $status, $refuse)
    {
        $data = [
            'status' => $status ,
            'reason_for_rejection' => $refuse
        ];
        $refuse = $this->update($data, $id);
        $this->sendMailApply($id,self::TU_CHOI);
        return $refuse;
    }

    public function isPublic($id, $isPublic)
    {
        $data = [
            'isPublic'=>$isPublic
        ];
        return $this->update($data, $id);
    }

    public function ChooseCalendar($date, $id)
    {
        $this->sendMailApply($id,self::HEN_LICH_PHONG_VAN);
        $data = [
            'interview_schedules'=>$date,
            'status' => 6
        ];
        return $this->update($data, $id);
    }

    private function update($data, $id)
    {
        return $this->apply->where('id',$id)->update($data);
    }

    public function getDetailApply($id)
    {
        return $this->apply->with('job')->where('id', $id)->first();
    }

    public function getPaperApply($id)
    {
        return $this->nbPaper->where('apply_id', $id)->first();
    }

    public function getApplyAdmin($request,$status)
    {
        $condition = [];
        if($status){
            $condition[] = ['nb_applies.status','=',$status];
        }
        $query = $this->getApplyValid()
                    ->where($condition);
        if( $request->status == self::CHUAPHEDUYET) {
            $query->where('nb_applies.status',self::CHO_DUYET);
        } else if($request->status == self::DAPHEDUYET) {
            $query->where('nb_applies.status',self::ADMIN_DUYET_CV);
        } else if($request->status == self::LICHPHONGVAN) {
            $query->where('nb_applies.status',self::NTD_DUYET_HO_SO);
        } else if($request->status == self::HUY) {
            $query->where('nb_applies.status',self::TU_CHOI);
        }
        return $query->get();
    }

    public function getApplyHr($status)
    {
        $condition = [];
        if($status){
            $condition[] = ['nb_applies.status','=',$status];
        }
        return $this->getApplyValid()
                    ->where($condition)
                    ->where('user_id_submit' ,Auth::user()->id)
                    ->get();
    }
    public function getApplyCompany()
    {
        return $this->getApplyValid()
                    ->where('user_id_recever',Auth::user()->id)
                    ->where(function ($q) {
                        $q->where('status',self::ADMIN_DUYET_HO_SO)
                        ->orwhere('status', self::NTD_DUYET_HO_SO);
                    })
                    ->get();
    }

    private function getApplyValid()
    {
        return $this->apply->with(['user' => function ($q) {
                                $q->select('id', 'name', 'avatar');
                                $q->where([
                                    'status' => self::ACTIVE,
                                    'block' =>self::UN_BLOCK
                                ]);
                            }])
                            ->with('nbPaper')
                            ->with(['job' => function ($q) {
                                $q->select('currency', 'title','id');
                            }])
                            ->whereHas('job', function ($query) {
                                $query->where([
                                    'deleted' => self::UN_DELETE,
                                    'status' => self::ACTIVE,
                                    'isPublic' =>self::ACTIVE
                                ]);
                                
                            })
                            ->orderBy('id', 'DESC');
    }

    public function getBonus($id)
    {
        return NbJoblist::where('id', $id)->first()->bonus;
    }

    public function getIdCreated($id)
    {
        return NbJoblist::where('id', $id)->first()->id_created;
    }

    public function postPaperApply($data)
    {
        $rules = [
            'front_id_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'back_id_card' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'health_certification' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'high_school_diploma' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'passport' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'birth_certificate' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'curriculum_vitae' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'card_photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ];
        $messages = [
            'required' => 'Vui lòng tải lên đầy đủ giấy tờ!',
            'image' => 'Vui lòng tải lên định dạng ảnh',
            'mimes' => 'Định dạng file không hợp lệ',
        ];
        $validator = Validator::make($data->all(), $rules, $messages);
        if ($validator->fails()) {
            return [
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ];
        }
        try {
            $front_id_card = $this->uploadFile($data->file('front_id_card'));
            $back_id_card = $this->uploadFile($data->file('back_id_card'));
            $health_certification = $this->uploadFile($data->file('health_certification'));
            $high_school_diploma = $this->uploadFile($data->file('high_school_diploma'));
            $passport = $this->uploadFile($data->file('passport'));
            $birth_certificate = $this->uploadFile($data->file('birth_certificate'));
            $curriculum_vitae = $this->uploadFile($data->file('curriculum_vitae'));
            $card_photo = $this->uploadFile($data->file('card_photo'));
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
        $insert = [
            'front_id_card' => $front_id_card,
            'back_id_card' => $back_id_card,
            'health_certification' => $health_certification,
            'high_school_diploma' => $high_school_diploma,
            'passport' => $passport,
            'birth_certificate' => $birth_certificate,
            'curriculum_vitae' => $curriculum_vitae,
            'card_photo' => $card_photo,
            'apply_id' => $data->apply_id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
        $check =  $this->nbPaper->insert($insert);
        if($check) {
            $this->sendMailApply($data->apply_id,self::CHO_DUYET_HO_SO);
            return [
                'status' => 200,
                'message' => 'Thêm thành công! Đợi admin xét duyệt',
                'data' => null
            ];
        }
        return [
            'status' => 400,
            'message' => 'Upload thất bại',
            'data' => null
        ];
    }

    private function uploadFile($file)
    {
        $fileinfo = pathinfo($file->getClientOriginalName());
        $file_cv = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
        $uploadPath = '/home/netbee.vn/html/static/uploads/apply/files/';
        $file->move($uploadPath, $file_cv );
        return $file_cv;
    }


    public function getCalendar()
    {
        $userRole = Auth::user()->role;
        if ($userRole == self::ROLE_ADMIN) {
            $get = $this->getCalendarAdmin();
        } else if ($userRole == self::ROLE_COMPANY) {
            $get = $this->getCalendarCompany();
        } else {
            $get = $this->getCalendarUser();
        }
        $days = [];
        $data = [];
        foreach ($get as $key => $value){
            $days['id'] = $value->id;
            $days['start'] = $value->interview_schedules;
            $days['title'] = "LPV".$value->job->title;
            $days['idjob'] = $value->job->id;
            $days['email'] =    $value->user->email;
            $days['phone'] =    $value->user->phone;
            $days['name'] =    $value->user->name;
            $days['address'] =    $value->user->address_detail;
            $dateromm = Carbon::parse($value->created_at)->format('Ymd');
            $days['id_room'] = $dateromm.$value->id;
            $days['status_call'] = $value->status_call;
            $daystime = Carbon::parse($value->interview_schedules)->format('Y-m-d');
            $timedays = Carbon::now()->format('Y-m-d');
            if($daystime < $timedays){
                $days['color'] =  '#BB3511';
            }else if($daystime == $timedays){
                $days['color'] =  '#1DA273';
            }else{
                $days['color'] =  '#D39B0E';
            }
            array_push($data,$days);
        }
        return $data;
    }

    // public function getInterview()
    // {
    //     $userRole = Auth::user()->role;
    //     if ($userRole == self::ROLE_ADMIN) {
    //         $data = $this->getCalendarAdmin();
    //     } else if ($userRole == self::ROLE_COMPANY) {
    //         $data = $this->getCalendarCompany();
    //     } else {
    //         $data = $this->getCalendarUser();
    //     }
    //     return $data;
    // }

    public function getCalendarAdmin()
    {
        return $this->getApplyCalendar()
                    ->where('status' ,self::NTD_DUYET_HO_SO)
                    ->whereNotNull('interview_schedules')
                    ->orderByDesc('interview_schedules')
                    ->get();
    }

    public function getCalendarCompany()
    {
        return $this->getApplyCalendarCompany()
                    ->where('status' ,self::NTD_DUYET_HO_SO)
                    ->whereNotNull('interview_schedules')
                    ->orderByDesc('interview_schedules')
                    ->get();
    }

    public function getCalendarUser()
    {
        return $this->getApplyCalendar()
                    ->where('status' ,self::NTD_DUYET_HO_SO)
                    ->whereNotNull('interview_schedules')
                    ->where('user_id_submit' ,Auth::user()->id)
                    ->orderByDesc('interview_schedules')
                    ->get();
    }

    private function getApplyCalendar()
    {
        return $this->apply->with(['job' => function ($q) {
                            $q->select('currency', 'title','id');
                            $q->where([
                                'deleted' => self::UN_DELETE,
                                'status' => self::ACTIVE,
                                'isPublic' =>self::ACTIVE
                            ]);
                            }])
                            ->with(['user' => function ($q) {
                                $q->select('id','name', 'address_detail','phone','email');
                            }])
                            ->orderBy('id', 'DESC');
    }

    private function getApplyCalendarCompany()
    {
        return $this->apply->with(['job' => function ($q) {
                $q->select('currency', 'title','id');
                $q->where([
                    'id_created'=> Auth::user()->id,
                    'deleted' => self::UN_DELETE,
                    'status' => self::ACTIVE,
                    'isPublic' =>self::ACTIVE
                ]);
            }]);
    }

    public function getCreateCall()
    {
        $userRole = Auth::user()->role;
        if ($userRole == self::ROLE_ADMIN) {
            $data = $this->getCallAdmin();
        } else if ($userRole == self::ROLE_COMPANY) {
            $data = $this->getCallCompany();
        }
        return $data;
    }

    public function getCallAdmin()
    {
        return $this->nbCreateCall
            ->with(['nbjob' => function ($q) {
                $q->select('title', 'id');
                $q->where([
                    'deleted' => self::UN_DELETE,
                    'status' => self::ACTIVE,
                    'isPublic' =>self::ACTIVE,
                ]);
            }])
            ->with(['Apply' =>function ($q) {
                $q->select('interview_schedules', 'id');
                $q->orderByDesc('interview_schedules');
            }])
            ->with(['user' => function ($q) {
                $q->select('id','name', 'address_detail','phone','email');
            }])
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function getCallCompany()
    {
        return $this->nbCreateCall
            ->with(['nbjob' => function ($q) {
                $q->select('title', 'id');
                $q->where([
                    'id_created'=> Auth::user()->id,
                    'deleted' => self::UN_DELETE,
                    'status' => self::ACTIVE,
                    'isPublic' =>self::ACTIVE
                ]);
            }])
            ->with(['Apply' =>function ($q) {
                $q->select('interview_schedules', 'id');
                $q->orderByDesc('interview_schedules');
            }])
            ->with(['user' => function ($q) {
                $q->select('id','name', 'address_detail','phone','email');
            }])
            ->orderBy('id', 'DESC')
            ->get();
    }
    public function insertCreateCall($data)
    {
        return $this->nbCreateCall->insert($data);
    }

    public function updateAppliesCall($data,$id)
    {
        return $this->apply->whereId($id)->update($data);
    }

    public function insertHisCall($data)
    {
        return $this->nbHistoryCall->insert($data);
    }

    public function getHisCall($id_room)
    {
        return $this->nbHistoryCall
            ->where('id_room' ,$id_room)
            ->with(['user' => function ($q) {
                $q->select('id','name',);
            }])
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function CountCreateCall()
    {
        return $this->nbCreateCall
        ->where('id_user' ,Auth::user()->id)
        ->count();
    }

}
