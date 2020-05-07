<?php
namespace App\Services;

use App\Models\EducationUser;
use App\Models\ProfileUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Auth;

class TeamplateCvService {

    const
        ACTIVE = 1,
        INACTIVE = 0;

    protected $profileUser;
    protected $educationUser;

    public function __construct(ProfileUser $profileUser, EducationUser $educationUser)
    {
        $this->profileUser = $profileUser;
        $this->educationUser = $educationUser;
    }

    public function getProfileById($id)
    {
        return $this->profileUser->whereId($id);
    }

    public function getEducationById($id)
    {
        return $this->educationUser->whereId($id);
    }

    public function getListProfileById($id)
    {
        return $this->getProfileById($id)->first();
    }

    public function getListEducationById($id)
    {
        return $this->getEducationById($id)->get();
    }

    public function getListEducationByIdUser($idUser)
    {
        return $this->educationUser->where('id_profile_user','=',$idUser)->get();
    }

    public function updateProfile($data, $id)
    {
        return $this->getProfileById($id)->update($data);
    }

    public function updateEducation($data, $id)
    {
        return $this->getJobById($id)->update($data);
    }

    public function deleteEducation($id)
    {
        try {
            $education = $this->getEducationById($id)->first();
            if($education) {
                $data = [
                    'deleted' => self::ACTIVE,
                    'updated_at' => Carbon::now()
                ];
                $delete = $this->update($data, $id);
                return [
                    'status'=> 200,
                    'message' => 'Đã xóa thành công',
                    'data' => $delete
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Xóa không thành công',
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
