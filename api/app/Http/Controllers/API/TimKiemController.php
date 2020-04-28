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
        $bonus = $request->bonus;

        $search = DB::table('nb_joblists')
        ->where(function($query) use ($keyword){
            if($keyword != ''){
                $query->where('title', 'like', '%'. $keyword . '%')
                ->orwhere('description', 'like', '%'. $keyword . '%');
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
                $query->where('salary_start', '<=', $salary_end);
            }
        })
        ->where(function($query) use ($work_form){
            if($work_form != ''){
                $query->where('salary_start', '<=', $work_form);
            }
        })
        ->where(function($query) use ($work_form){
            if($work_form != ''){
                $query->where('work_form', $work_form);
            }
        })
        ->where('deleted', 0)
        ->where('isPublic',1)
        ->where('status', 1)
        ->get();

        if($search)
            $data = ['status'=> 200, 'message' => 'Thành công', 'data' => $search];
        else
            $data = ['status'=> 400, 'message' => 'Lỗi', 'data' => null];
        return response()->json($data);
    }
}
