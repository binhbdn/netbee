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
}
