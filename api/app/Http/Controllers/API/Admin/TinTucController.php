<?php

namespace App\Http\Controllers\API\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Auth;
use App\User;
use Validator;
use Hash;
use Carbon\Carbon;
use App\Mail\Sendmail;
use App\Services\PayUService\Exception;
use App\Helpers\AppHelpers;

use App\Http\Controllers\NotificationController as notifi;

class TinTucController extends Controller
{

    public function getTinTuc(Request $request)
    {
        try {
            $getTin = DB::select('CALL getNewsAdmin(0,0)');
            $data = ['status'=> 200, 'message' => 'Thay đổi trạng thái thành công', 'data' => $getTin];
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function changeStatusTinTuc(Request $request)
    {
        try {
            $id = $request->id;
            $getTin = DB::table('news')->where('id', $id)->first();
            if($getTin) {
                $setTin = DB::table('news')
                ->where('id', $id)
                ->update([
                    'status' => !$getTin->status,
                    'updated_at' => Carbon::now()
                ]);
                $data = ['status'=> 200, 'message' => 'Thay đổi trạng thái thành công', 'data' => $setTin];
            }else {
                $data = ['status'=> 400, 'message' => 'Tin không tồn tại', 'data' => null];
            }
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }
    public function changeMultipleStatusTinTuc(Request $request)
    {   
        if(empty($request->id)){
            $data = ['status'=> 400, 'message' => 'Bạn chưa chọn tin!', 'data' => null];
            return response()->json($data);
        }
        $id = json_decode($request->id);
        $length= count($id);
        $status = $request->status;
        DB::beginTransaction();
        try {
            if($length == 1 ){
                DB::table('news')->where('id', $id)->update([
                    'status' => $status,
                    'updated_at' =>  Carbon::now()
                ]);
                DB::commit();
                $tin = DB::table('news')->where('id',$id)->get();
                if($status == 1){
                    $data = ['status'=> 200, 'message' => 'Kích hoạt thành công', 'data' => null];
                }
                else{
                    $data = ['status'=> 200, 'message' => 'Bỏ kích hoạt thành công', 'data' => null];
                }
            }
            else{
                foreach($id as $key =>$value) {
                    DB::table('news')->where('id', $value)->update([
                        'status' => $status,
                        'updated_at' =>  Carbon::now()
                    ]);
                }
                DB::commit();
                if($status == 1){
                    $data = ['status'=> 200, 'message' => 'Kích hoạt thành công', 'data' => null];
                }
                else{
                    $data = ['status'=> 200, 'message' => 'Bỏ kích hoạt thành công', 'data' => null];
                }
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function deleteTinTuc(Request $request)
    {
        try {
            $id = $request->id;
            $getTin = DB::table('news')->where('id', $id)->first();
            if($getTin) {
                $setTin = DB::table('news')
                ->where('id', $id)
                ->update([
                    'deleted' => 1,
                    'updated_at' => Carbon::now()
                ]);
                $data = ['status'=> 200, 'message' => 'Xóa tin thành công', 'data' => $setTin];
            }else {
                $data = ['status'=> 400, 'message' => 'Tin không tồn tại', 'data' => null];
            }
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }
    public function deleteMultipleTinTuc(Request $request)
    {   
        if(empty($request->id)){
            $data = ['status'=> 400, 'message' => 'Bạn chưa chọn tin!', 'data' => null];
            return response()->json($data);
        }
        $id = json_decode($request->id);
        $length= count($id);
        DB::beginTransaction();
        try {
            if($length == 1 ){
                DB::table('news')->where('id', $id)->update([
                    'deleted' => 1,
                    'updated_at' =>  Carbon::now()
                ]);
                DB::commit();
                $tin = DB::table('news')->where('id',$id)->get();
                    $data = ['status'=> 200, 'message' => 'Xóa tin thành công', 'data' => null];
            }
            else{
                foreach($id as $key =>$value) {
                    DB::table('news')->where('id', $value)->update([
                        'deleted' => 1,
                        'updated_at' =>  Carbon::now()
                    ]);
                }
                DB::commit();
                    $data = ['status'=> 200, 'message' => 'Xóa tin thành công', 'data' => null];
                
            }
        } catch (\Exception $e) {
            DB::rollBack();
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function createTinTuc(Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'content' => 'required',
            'title' => 'required',
            'short_content' => 'required',
            'thuml' => 'required|image',
            'id_category' => 'required',
        ],
        [
            'required' => 'Không được để trống',
            'image' => 'Định dạng ảnh không phù hợp',
        ]);
         
        if ($validator->fails()) {
             return response()->json([
                 'status' => 400,
                 'message' => $validator->messages()->first(),
                 'data' => null
             ]);
        }
        try {
            $file = $request->file('thuml');
            $fileinfo = pathinfo($file->getClientOriginalName());
            $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
            $uploadPath = '/home/netbee.vn/html/static/uploads/news/';
            $insert = [
                'title' => $request->title,
                'short_content' => $request->short_content,
                'content' => $request->content,
                'id_category' => $request->id_category,
                'user_created' => Auth::user()->id,
                'thuml' => $image,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
            $file->move($uploadPath, $image);
            $check = DB::table('news')->insert($insert);
            $data = ['status' => 200,'message' => 'Tạo tin thành công', 'data' => null];
        } catch (\Exception $e) {
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function updateTinTuc(Request $request)
    {
        $getTin = DB::table('news')->where('id', $request->id)->where('deleted',0)->first();
        if($getTin) 
        {
            if($request->file('thuml'))
            {
                $validator = Validator::make($request->all(),
                [
                    'content' => 'required',
                    'title' => 'required',
                    'short_content' => 'required',
                    'thuml' => 'required|image',
                    'id_category' => 'required',
                ],
                [
                    'required' => 'Không được để trống',
                    'image' => 'Định dạng ảnh không phù hợp',
                ]);
                 
                if ($validator->fails()) {
                     return response()->json([
                         'status' => 400,
                         'message' => $validator->messages()->first(),
                         'data' => null
                     ]);
                }
                try {
                    $file = $request->file('thuml');
                    $fileinfo = pathinfo($file->getClientOriginalName());
                    $image = time().'.'.seoname($fileinfo['filename']).'.'.strtoupper($file->getClientOriginalExtension());
                    $uploadPath = '/home/netbee.vn/html/static/uploads/news/';
                    $insert = [
                        'title' => $request->title,
                        'short_content' => $request->short_content,
                        'content' => $request->content,
                        'id_category' => $request->id_category,
                        'thuml' => $image,
                        'updated_at' => Carbon::now()
                    ];
                    //remove file old
                    if(file_exists($uploadPath.$getTin->thuml)){
                        unlink($uploadPath.$getTin->thuml);
                    }
                    $file->move($uploadPath, $image);
                    $check = DB::table('news')->where('id', $request->id)->update($insert);
                    $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
                } catch (\Exception $e) {
                    $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
                }
            }else 
            {
                $validator = Validator::make($request->all(),
                [
                    'content' => 'required',
                    'title' => 'required',
                    'short_content' => 'required',
                    'id_category' => 'required',
                ],
                [
                    'required' => 'Không được để trống',
                ]);
                
                if ($validator->fails()) {
                    return response()->json([
                        'status' => 400,
                        'message' => $validator->messages()->first(),
                        'data' => null
                    ]);
                }
                try {
                    $insert = [
                        'title' => $request->title,
                        'short_content' => $request->short_content,
                        'content' => $request->content,
                        'id_category' => $request->id_category,
                        'updated_at' => Carbon::now()
                    ];
                    $check = DB::table('news')->where('id', $request->id)->update($insert);
                    $data = ['status' => 200,'message' => 'Cập nhật tin thành công', 'data' => null];
                } catch (\Exception $e) {
                    $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
                }
            }
        } else
        {
            $data = ['status'=> 400, 'message' => 'Tin đã bị xóa', 'data' => null];
        }
        return response()->json($data);
    }
    public function searchTinTuc(Request $request)
    {
        $search = $request->search;
        $searchTitle = $request->searchTitle;
        $searchCategory = $request->searchCategory;
        $searchStatus = $request->searchStatus;
        if($search == '' && $searchTitle == '' && $searchStatus == '' && $searchCategory == '') 
        {
            $data = DB::table('news')->where('deleted', 0)->orderBy('id', 'DESC')->paginate(10);
        }
        else
        {
            $data = DB::table('news')->select('*')
            ->where(function($query) use ($search){
                if($search != ''){
                    $query->where('title', 'LIKE', '%'.$search.'%')
                    ->orwhere('id','LIKE', '%'.$search.'%');
                }
            })
            ->where(function($query) use ($searchTitle){
                if($searchTitle != ''){
                    $query->where('title', 'LIKE', '%'.$searchTitle.'%');
                }
            })
            ->where(function($query) use ($searchStatus){
                if($searchStatus != ''){
                    $query->where('status', $searchStatus);
                }
            })
            ->where(function($query) use ($searchCategory){
                if($searchCategory != ''){
                    $query->where('id_category', $searchCategory);
                }
            })
            ->where('deleted', 0)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        }
        return response()->json($data);
    }
    
}