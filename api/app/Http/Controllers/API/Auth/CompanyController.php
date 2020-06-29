<?php

namespace App\Http\Controllers\API\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\NbCompanyInfoService;
use Auth;
use Validator;
use Carbon\Carbon;

class CompanyController extends Controller
{
    protected $nbCompanyInfoService;

    public function __construct(NbCompanyInfoService $nbCompanyInfoService)
    {
        $this->nbCompanyInfoService = $nbCompanyInfoService;
    }

    public function getInfoCompany(Request $request)
    {
        $data =  [
            'status'=> 400,
            'message' => 'Bạn chưa cập nhật thông tin công ty',
            'data' => null
        ];

        $info = $this->nbCompanyInfoService->getInfoByUserId(Auth::user()->id)->first();
        if ($info) {
            $data = [
                'status' => 200,
                'message' => 'Thành công',
                'data' => $info
            ];
        }
        return response()->json($data);
    }
    public function changeInfoCompany(Request $request)
    {
        $rules = [
                'company_hotline' => 'required|numeric',
                'company_about' => 'required',
                'username' => 'required',
                'company_tax' => 'required|numeric',
                'company_benefit' => 'required',
                'company_policy' => 'required',
                'company_chance' => 'required',
                'company_link' => 'required'
        ];
        $messages = [
                'required' => 'Không được để trống',
                'numeric' => 'Số điện thoại không được chứa kí tự'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()->first(),
                'data' => null
            ]);
        }
        $data = [
            // 'image_cover' => $request->image_cover ? $request->image_cover : null ,
            'company_hotline' => $request->company_hotline,
            'company_about' => $request->company_about,
            'username' => $request->username,
            'company_tax' => $request->company_tax,
            'company_benefit' => $request->company_benefit,
            'company_policy' => $request->company_policy,
            'company_chance' => $request->company_chance,
            'company_link' => $request->company_link,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];        
        if($request->file('image_cover')) {
            try {
                $file = $request->file('image_cover');
                $fileinfo = pathinfo($file->getClientOriginalName());
                $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());                
                $uploadPath = '/home/netbee.vn/html/static/uploads/users/covers';
                $data['image_cover'] = $image;                
                $get = $this->nbCompanyInfoService->getInfoByUserId(Auth::user()->id)->first();
                $userId = Auth::user()->id;
                if ($get) {
                    $file->move($uploadPath, $image);
                    $response = $this->nbCompanyInfoService->updateByUserId($data, $userId);             
                } else {         
                    $data['company_id'] = $userId;
                    
                    $response = $this->nbCompanyInfoService->store($data);   
                }

                if ($response) {
                    return [
                        'status' => 200,
                        'message' => 'Cập nhật tin thành công',
                        'data' => null
                    ];
                }
                //remove file old                
                if($get->image_cover != NULL && file_exists($uploadPath.$get->image_cover))
                {
                    unlink($uploadPath.$get->image_cover);
                }
                $file->move($uploadPath, $image);
            } catch (\Exception $e) {
                return [
                    'status'=> 400,
                    'message' => 'Có lỗi xảy ra',
                    'data' => $e->getMessage()
                ];
            }           
        }       
        return [
            'status' => 400,
            'message' => 'Có lỗi xảy ra',
            'data' => null
        ];
    }

    public function checkUsernameCompany(Request $request)
    {
        $data = $this->nbCompanyInfoService->checkUsernameCompany($request->username);
        if($data) {
            return [
                'status' => 400,
                'message' => 'Đã tồn tại',
                'data' => null
            ];
        }
        return [

            'status' => 200,
                'message' => 'Tên hợp lệ',
                'data' => null
        ];
    }
}
