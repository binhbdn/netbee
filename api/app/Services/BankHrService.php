<?php
namespace App\Services;

use App\Models\NbBankHr;
use JWTAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Validator;

class BankHrService extends BaseService {

    protected $nbBankHr;

    public function __construct( NbBankHr $nbBankHr) 
    {
        $this->nbBankHr = $nbBankHr;
    }

    public function getId($id)
    {
        return $this->nbBankHr->whereId($id);
    }

    private function ValiRequest($request)
    {
        $rules = [
            'name' => 'required',
            'stk' => 'required',
            'branch' => 'required',
            'bankName' => 'required'
        ];
        $messages = [
            'required' => 'Vui lòng nhập đầy đủ thông tin',
        ];

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
    
    private function DataRequest($request)
    {   
        $response = [
            'id_user' => Auth::user()->id,
            'name' => $request->name,
            'stk' => $request->stk,
            'branch' => $request->branch,
            'bankName' => $request->bankName
        ];

        return $response;
    }

    public function update($data, $id)
    {   
        return $this->nbBankHr->whereId($id)->update($data);
    }

    public function updateData(Request $request)
    {   
        $validate = $this->ValiRequest($request);
        if ($validate) {
            return $validate;
        }
        $data = $this->DataRequest($request);
        try {
            $this->update($data, $id);
            return [
                'status' => 200,
                'message' => 'Cập nhật thông tin ngân hàng thành công',
                'data' => null
            ];
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
        return $this->nbBankHr->whereId($userId)->update($data);
    }

    public function store(Request $request)
    {
        $validate = $this->ValiRequest($request);
        if ($validate) {
            return $validate;
        }
        $data = $this->DataRequest($request);
        try {
            $this->nbBankHr->create($data);
            return [
                'status' => 200,
                'message' => 'Thêm thông tin ngân hàng thành công',
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

    public function EditData(Request $request)
    {
        $validate = $this->ValiRequest($request);
        if ($validate) {
            return $validate;
        }
        $data = $this->DataRequest($request);
        try {
            $get = $this->nbBankHr->where('id_user',Auth::user()->id)->first();
            if($get) {
                $this->update($data, $get->id);
                return [
                    'status' => 200,
                    'message' => 'Cập nhật thông tin ngân hàng thành công',
                    'data' => null
                ];
            } else {
                $this->nbBankHr->create($data);
                return [
                    'status' => 200,
                    'message' => 'Thêm thông tin ngân hàng thành công',
                    'data' => null
                ];
            }
        } catch (\Exception $e) {
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }
    
    public function getByIt($id)
    {   
        return $this->nbBankHr->where('id_user',Auth::user()->id)->first();
    }
    

}
