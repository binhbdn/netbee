<?php
namespace App\Services;

use App\Models\Apply;
use App\Models\NbJoblist;
use App\Models\NbPaper;
use App\Models\NbCreateCall;
use App\Models\NbHistoryCall;
use Auth;
use Validator;
use Carbon\Carbon;

class ApplyJobService extends BaseService {

    protected $nbJobList;
    protected $apply;
    protected $nbPaper;
    protected $nbCreateCall;

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

    public function getApply($status)
    {
        $userRole = Auth::user()->role;
        if ($userRole == self::ROLE_ADMIN) {
            $data = $this->getApplyAdmin($status);
        } else if ($userRole == self::ROLE_COMPANY) {
            $data = $this->getApplyCompany($status);
        } else {
            $data = $this->getApplyHr($status);
        }
        return $data;
    }

    public function changeStatusApply($id, $status)
    {
        $data = [
            'status'=>$status
        ];
        return $this->update($data, $id);
    }

    public function refuse($id, $status, $refuse)
    {
        $data = [
            'status' => $status ,
            'reason_for_rejection' => $refuse
        ];
        return $this->update($data, $id);
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

    public function getApplyAdmin($status)
    {
        $condition = [];
        if($status){
            $condition[] = ['nb_applies.status','=',$status];
        }
        return $this->getApplyValid()
                    ->where($condition)->get();
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
    public function getApplyCompany($status)
    {
        return $this->getApplyValid()
                    ->where('user_id_recever' ,Auth::user()->id)
                    ->where('status' ,self::ADMIN_DUYET_HO_SO)
                    ->orwhere('status', self::NTD_DUYET_HO_SO)
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
                                $q->where([
                                    'deleted' => self::UN_DELETE,
                                    'status' => self::ACTIVE,
                                    'isPublic' =>self::ACTIVE
                                ]);
                            }])
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
}
