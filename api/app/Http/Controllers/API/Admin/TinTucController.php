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
            $uploadPath = '/home/en-el.devwork.vn/public_html/static/uploads/news/';
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
                    $uploadPath = '/home/en-el.devwork.vn/public_html/static/uploads/news/';
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
        if($search == '' && $searchTitle == '' && $searchStatus == null && $searchCategory == null) 
        {
            $data = DB::table('news')->get();
        }
        else
        {
            $data = DB::table('news')->select('*')
            ->where(function($query) use ($search,$searchTitle,$searchStatus,$searchCategory){
                if($search != ''){
                    if($searchTitle == '' && $searchStatus==null & $searchCategory==null)
                    {
                        $query->where('title', 'LIKE', '%'.$search.'%')
                        ->orwhere('id','LIKE', '%'.$search.'%');
                    }
                    elseif($searchTitle != '' && $searchStatus==null && $searchCategory==null){
                        $query->where('title', 'LIKE', '%'.$searchTitle.'%');
                    }
                    elseif($searchTitle == '' && $searchStatus !=null && $searchCategory==null){
                        $query->where('title', 'LIKE', '%'.$search.'%')
                        ->where('status',$searchStatus);
                    }
                    elseif($searchTitle == '' && $searchStatus ==null && $searchCategory!=null){
                        $query->where('title', 'LIKE', '%'.$search.'%')
                        ->where('id_category',$searchCategory);
                    }
                    elseif($searchTitle != '' && $searchStatus !=null && $searchCategory==null){
                        $query->where('title', 'LIKE', '%'.$search.'%')
                        ->orwhere('id','LIKE', '%'.$search.'%')
                        ->where('status',$searchStatus);
                    }
                    elseif($searchTitle != '' && $searchStatus !=null && $searchCategory!=null){
                        $query->where('title', 'LIKE', '%'.$search.'%')
                        ->orwhere('id','LIKE', '%'.$search.'%')
                        ->where('status',$searchStatus)
                        ->where('id_category',$searchCategory);
                    }
                }
                else {
                    if($searchTitle != ''){
                        if($searchStatus == null && $searchCategory==null){
                            $query->where('title', 'LIKE', '%'.$searchTitle.'%');
                        }
                        elseif ($searchStatus != null && $searchCategory==null) {
                            $query->where('title', 'LIKE', '%'.$searchTitle.'%')
                            ->where('status',$searchStatus);
                        }
                        elseif ($searchStatus == null && $searchCategory!=null) {
                            $query->where('title', 'LIKE', '%'.$searchTitle.'%')
                            ->where('id_category',$searchCategory);
                        }
                        elseif ($searchStatus != null && $searchCategory!=null) {
                            $query->where('title', 'LIKE', '%'.$searchTitle.'%')
                            ->where('status',$searchStatus)
                            ->where('id_category',$searchCategory);
                        }
                    }
                    else {
                        if($searchStatus != null && $searchCategory==null){
                            $query->where('status',$searchStatus);
                        }
                        elseif($searchStatus == null && $searchCategory!=null){
                            $query->where('id_category',$searchCategory);
                        }
                        elseif($searchStatus != null && $searchCategory!=null){
                            $query->where('status',$searchStatus)
                            ->where('id_category',$searchCategory);
                        }
                    }
                }
            });
            $data = $data->paginate(10);
        }
        return response()->json($data);
    }
    public function filter_hr_admin(Request $request){
        $search = $request->search;
        $approved = $request->approved;
        $notapproved = $request->notapproved;
        $blocks =  $request->blocks;
        $unblocks =  $request->unblocks;
        $sort_date = $request->sort_date;
        $sort_login = $request->sort_login;
        $sort_mode = $request->sort_mode;
        if($search == '' &&  $approved == 0 &&  $notapproved == 0 &&  $blocks == 0 &&  $unblocks == 0 ){
            $list = DB::table('admins')->where('level','4');
            if($sort_mode == 0){
              $list->orderBy('time_login',$sort_date);
            }else if($sort_mode == 1){
              $list->orderBy('count_logined',$sort_login);
            }else{
              $list->where('status', '0');
            }
            $list = $list->orderBy('id', 'DESC')->paginate(10);
        }else{
            $list = DB::table('admins')->select('*')
            ->where(function($query) use ($search){
                if($search != ''){
                    $query->where('username', 'LIKE', '%'.$search.'%')
                          ->orwhere('fullname', 'LIKE', '%'.$search.'%')
                          ->orwhere('id', 'LIKE', '%'.$search.'%')
                          ->orwhere('email', 'LIKE', '%'.$search.'%');
                }
            })
             ->where(function($query) use ($approved, $notapproved, $blocks, $unblocks){
            if($approved == 1)
            {
              $query->where('admins.status', '1');
            
            }elseif($notapproved == 1){
              $query->where('admins.status', '0');
           }elseif($blocks == 1){
            $query->where('admins.block', '0')
            ->where('admins.status', '!=', 0);
           }elseif($unblocks == 1){
            $query->where('admins.block', '1')
            ->where('admins.status', '!=', 0);
           }       
            })
            ->where('level','4')->orderBy('id', 'DESC');
            if($sort_mode == 0){
              $list->orderBy('time_login',$sort_date);
            }else{
              $list->orderBy('count_logined',$sort_login);
            }
            $list = $list->paginate(10); 
        }
        return response::json(['list' => $list]);
      }
    
}