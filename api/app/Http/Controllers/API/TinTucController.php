<?php

namespace App\Http\Controllers\API;

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

use App\Http\Controllers\NotificationController as notifi;

class TinTucController extends Controller
{

    public function getTinTucNew(Request $request)
    {
        $limit = $request->limit;
        $datas['tintuc'] = DB::select('CALL GetNews(0,'.$limit.')');
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }
    public function getTinTucNewLoading(Request $request)
    {
        $category = $request->category;
        if($category){
            $datas['tintuc'] = DB::table('news')
            ->where('id_category',$category)
            ->where('status',1)
            ->where('deleted',0)
            ->paginate(5);
        }else{
            $datas['tintuc'] = DB::table('news')
            ->where('status',1)
            ->where('deleted',0)
            ->paginate(5);
        }
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }

    public function getDanhMucTinTuc(Request $request)
    {
        $datas = DB::select('CALL GetNewsDanhMuc()');
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }

    public function getTinTucCate(Request $request)
    {
        $limit = $request->limit;
        $category = $request->category;
        $datas['tintuc'] = DB::select('CALL GetNews('.$category.','.$limit.')');
        if($datas)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $datas];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }


    public function getDetailTinTuc(Request $request)
    {
        $tin = DB::table('news')
        ->leftJoin('users', 'news.user_created', '=','users.id')
        ->select('news.*','users.name as user_created_name')
        ->where('news.id', $request->id)
        ->first();
        if($tin)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $tin];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi get tin', 'data' => null];
        return response()->json($data);
    }

}