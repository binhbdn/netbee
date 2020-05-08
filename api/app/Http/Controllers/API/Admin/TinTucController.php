<?php

namespace App\Http\Controllers\API\Admin;

use App\Services\NewsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Response;
use JWTAuth;
use Auth;
use Validator;
use Hash;
use Carbon\Carbon;
use App\Services\PayUService\Exception;
use App\Helpers\AppHelpers;

class TinTucController extends Controller
{
    protected $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function getTinTuc()
    {
        $response = $this->newsService->getNews();
        return response()->json($response);
    }

    public function changeStatusTinTuc(Request $request)
    {
        $response = $this->newsService->changeStatus($request->id);
        return response()->json($response);
    }

    public function changeMultipleStatusTinTuc(Request $request)
    {
        $response = $this->newsService->changeMultiStatus($request);
        return response()->json($response);
    }

    public function deleteTinTuc(Request $request)
    {
        $response = $this->newsService->destroy($request->id);
        return response()->json($response);
    }

    public function deleteMultipleTinTuc(Request $request)
    {
        $response = $this->newsService->multiDestroy($request);
        return response()->json($response);
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
        $role_user = Auth::user()->role;
        $id_user = Auth::user()->id;
        $search = $request->search;
        $searchTitle = $request->searchTitle;
        $searchCategory = $request->searchCategory;
        $searchStatus = $request->searchStatus;
        if($search == '' && $searchTitle == '' && $searchStatus == '' && $searchCategory == '')
        {
            if($role_user != 4){
                $data = DB::table('news')
                ->where('news.id_created',$id_user)
                ->where('news.deleted',0)
                ->orderBy('news.id', 'DESC')
                ->select('news.*')
                ->groupBy('news.id')
                ->paginate(6);
            }
            else{
                $data = DB::table('news')
                ->orderBy('news.id', 'DESC')
                ->where('news.deleted',0)
                ->select('news.*')
                ->groupBy('news.id')
                ->paginate(6);
            }
        }
        else
        {
            if($role_user != 4){
                $data = DB::table('news')
                ->where('news.id_created',$id_user)
                ->where('news.deleted',0)
                ->orderBy('news.id', 'DESC')
                ->select('news.*')
                ->groupBy('news.id')
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
                ->paginate(6);
            }
            else{
                $data = DB::table('news')
                ->orderBy('news.id', 'DESC')
                ->where('news.deleted',0)
                ->select('news.*')
                ->groupBy('news.id')
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
                ->paginate(6);
            }
        }
        return response()->json($data);
    }

}
