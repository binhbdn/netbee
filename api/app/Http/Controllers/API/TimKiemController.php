<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TimKiemController extends Controller
{
    public function searchCompany(Request $request){
        $search = DB::table('nb_companies_info')->join('users','users.id','=','nb_companies_info.company_id')
            ->where('users.name','like','%' . $request->keyword . '%')->orwhere('nb_companies_info.company_about','like','%' . $request->keyword . '%')->get();
        if($search)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $search];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi', 'data' => null];
        return response()->json($data);
    }

    public function getQuocGia() {
        try{
            $getQuocGia = DB::table('nations')->get();
            $data = ['status'=> 200, 'message' => 'thành công', 'data' => $getQuocGia];
        } catch (\Exception $e){
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function getVisa() {
        try{
            $getQuocGia = DB::table('visa_profession')->get();
            $data = ['status'=> 200, 'message' => 'thành công', 'data' => $getQuocGia];
        } catch (\Exception $e){
            $data = ['status'=> 400, 'message' => 'Có lỗi xảy ra', 'data' => $e->getMessage()];
        }
        return response()->json($data);
    }

    public function searchJobs(Request $request){
        $keyword = $request->keyword;
        $type = $request->type;
        $nation = $request->nation_id;
        $salary_start = $request->salary_start;
        $salary_end = $request->salary_end;
        $currency = $request->currency;
        $work_form = $request->work_form;
        $id_visa = $request->id_visa;
        $bonus = $request->bonus;
        $search = DB::table('nb_joblists')->select('nb_joblists.*', 'users.name', 'users.avatar', DB::raw('nations.name as nation_name'))
        ->where(function($query) use ($keyword){
            if($keyword == 'tin-noi-bat'){
                $query->where('highlight_job', 1);
            }
            else if($keyword != 'tin-noi-bat'){
                $query->where('title', 'like', '%'. $keyword . '%');
            }
        })
        ->where(function($query) use ($type){
            if($type != ''){
                $query->where('type', $type);
            }
        })
        ->where(function($query) use ($nation){
            if($nation != ''){
                $query->where('nation_id', $nation);
            }
        })
        ->where(function($query) use ($currency,$salary_start,$salary_end){
            if($currency != ''){
                $query->where('currency', $currency);
            }else if($salary_start != '' || $salary_end != ''){
                $query->where('currency', 'VND');
            }
        })
        ->where(function($query) use ($salary_start){
            if($salary_start != ''){
                $query->where('salary_start', '>=', $salary_start);
            }
        })
        ->where(function($query) use ($salary_end){
            if($salary_end != ''){
                $query->where('salary_end', '<=', $salary_end);
            }
        })
        ->where(function($query) use ($id_visa){
            if($id_visa != ''){
                $query->where('id_visa', $id_visa);
            }
        })
        ->where(function($query) use ($work_form){
            if($work_form != ''){
                $query->where('work_form', $work_form);
            }
        })
        ->where('deleted', 0)
        ->where('isPublic',1)
        ->where('nb_joblists.status', 1)
        ->join('users', 'users.id','=','id_created')
        ->join('nations', 'nb_joblists.nation_id', '=', 'nations.id')
        ->orderBy('nb_joblists.highlight_job', 'nb_joblists.created_at', 'DESC')
        ->groupBy('nb_joblists.id')
        ->get();

        if($search)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $search];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi', 'data' => null];
        return response()->json($data);
    }
}
