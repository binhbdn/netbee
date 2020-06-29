<?php
namespace App\Services;

use App\Models\NbAdvertisement;
use Auth;
use Carbon\Carbon;
use Validator;

class AdvertisementService extends BaseService {

    protected $advertisement;

    public function __construct(NbAdvertisement $advertisement)
    {
        $this->advertisement = $advertisement;
    }

    public function getAdvertisementById($id){
        return $this->advertisement->whereId($id);
    }

    public function update($data,$id){
        return $this->getAdvertisementById($id)->update($data);
    }
    
    public function getIdAdvertisement($request){
        $id = $request->id;
        try {
            $advertisement = $this->getAdvertisementById($id)->orderBy('id', 'DESC')->where('deleted',self::INACTIVE)->first();
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $advertisement
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function getAdvertisement(){
        try {
            $advertisement = $this->advertisement->orderBy('id', 'DESC')->where('deleted',self::INACTIVE)->get();
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $advertisement
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function dataAdvertisement($request)
    {
        $uploadPath = '/home/netbee.vn/html/static/uploads/news/';
        $response = [
            'name' => $request->name,
            'updated_at' => Carbon::now()
        ];
        if($request->file('picture')) {
            try {
                $file = $request->file('picture');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                $response['picture'] = $image;               
                $file->move($uploadPath, $image);
                if (empty($request->id)) {
                    $response['created_at'] = Carbon::now();
                } else {
                    $advertisement = $this->getAdvertisementById($request->id)->first();
                    if(file_exists($uploadPath.$advertisement->picture)){
                        unlink($uploadPath.$advertisement->picture);
                    }
                }
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi dữ liệu xảy ra',
                    'data' => $e->getMessage()
                ];
            }
        }
        return $response;
    }

    private function newsValidate($request)
    {
        $rules = [
            'name' => 'required',
        ];
        $messages = [
            'required' => 'Không được để trống',
        ];


        if (empty($request->id) || $request->file('picture')) {
            $rules['picture'] = 'required|image';
            $messages['image'] = 'Định dạng ảnh không phù hợp';
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

    public function updateAdvertisement($request)
    {
        $id = $request->id;
        $newsExists = $this->getAdvertisementById($id)->exists();
        if (!$newsExists) {
            return [
                'status'=> 400,
                'message' => 'Đã bị xóa',
                'data' => null
            ];
        }
        $validate = $this->newsValidate($request);
        if (!empty($validate)) {
            return $validate;
        }
        $data = $this->dataAdvertisement($request);
        try {
            $this->update($data, $id);
            return [
                'status' => 200,
                'message' => 'Cập nhật thành công',
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

    public function store($request)
    {
        $validate = $this->newsValidate($request);
        if (!empty($validate)) {
            return $validate;
        }
        $data = $this->dataAdvertisement($request);
        try {
            $this->advertisement->insert($data);
            return [
                'status' => 200,
                'message' => 'Tạo thành công',
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

    public function changeStatus($request)
    {
        try {
            $id = $request->id;
            $advertisement = $this->getAdvertisementById($id)->first();
            if($advertisement) {
                $data = [
                    'status' => !$advertisement->status,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Thay đổi trạng thái thành công',
                    'data' => $this->update($data, $id)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Dữ liệu hông tồn tại',
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

    public function deleted($request)
    {
        try {
            $id = $request->id;
            $advertisement = $this->getAdvertisementById($id)->first();
            if($advertisement) {
                $data = [
                    'deleted' => self::ACTIVE,
                    'updated_at' => Carbon::now()
                ];
                return [
                    'status'=> 200,
                    'message' => 'Xoá quảng cáo thành công',
                    'data' => $this->update($data, $id)
                ];
            }
            return [
                'status'=> 400,
                'message' => 'Dữ liệu hông tồn tại',
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
