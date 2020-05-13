<?php
namespace App\Services;

use App\Models\Nation;
use App\Models\NbCompanyInfo;
use App\User;
use App\Models\NbJoblist;
use App\Models\VisaProfession;
use Auth;

class SearchService extends BaseService {

    protected $nbCompanyInfo;
    protected $nation;
    protected $visaProfession;
    protected $nbJobList;
    protected $user;

    public function __construct(
        NbCompanyInfo $nbCompanyInfo,
        Nation $nation,
        VisaProfession $visaProfession,
        NbJoblist $nbJobList,
        User $user
    ) {
        $this->nbCompanyInfo = $nbCompanyInfo;
        $this->nation = $nation;
        $this->visaProfession = $visaProfession;
        $this->nbJobList = $nbJobList;
        $this->user = $user;
    }

    public function companies($keyword)
    {
        $condition = '%'.$keyword.'%';
        $search = $this->user->with('nbCompany')
            ->whereHas('nbCompany', function ($q) use ($condition) {
                $q->where('company_about', 'like', $condition);
            })
            ->orWhere('name', 'like', $condition)
            ->get();

        if($search) {
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $search
            ];
        }
        return [
            'status'=> 400,
            'message' => 'Lỗi',
            'data' => null
        ];
    }

    public function nations()
    {
        try{
            $nation = $this->nation->get();
            return [
                'status'=> 200,
                'message' => 'thành công',
                'data' => $nation
            ];
        } catch (\Exception $e){
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function visas()
    {
        try{
            $visa = $this->visaProfession->get();
            return [
                'status'=> 200,
                'message' => 'thành công',
                'data' => $visa
            ];
        } catch (\Exception $e){
            return [
                'status'=> 400,
                'message' => 'Có lỗi xảy ra',
                'data' => $e->getMessage()
            ];
        }
    }

    public function jobs($request)
    {
        $keyword = $request->keyword;
        $type = $request->type;
        $nation = $request->nation_id;
        $salaryStart = $request->salary_start;
        $salaryEnd = $request->salary_end;
        $currency = $request->currency;
        $workForm = $request->work_form;
        $idVisa = $request->id_visa;

        $conditions = [];

        $conditions[] = $keyword == 'tin-noi-bat' ?
            ['highlight_job', '=', self::ACTIVE] :
            ['title', 'like', '%'.$keyword.'%'];

        if ($type != '') {
            $conditions[] = ['type', '=', $type];
        }

        if ($nation != '') {
            $conditions[] = ['nation_id', '=', $nation];
        }

        if ($salaryStart != '') {
            $conditions[] = ['salary_start', '>=', $salaryStart];
        }

        if ($salaryEnd != '') {
            $conditions[] = ['salary_end', '<=', $salaryEnd];
        }

        if ($idVisa != '') {
            $conditions[] = ['id_visa', '=', $idVisa];
        }

        if ($workForm != '') {
            $conditions[] = ['work_form', '=', $workForm];
        }

        if ($currency != '' || $salaryStart != '' || $salaryEnd != '') {
            $typeCurrency = $currency != '' ? $currency : 'VND';
            $conditions[] = ['currency', '=', $typeCurrency];
        }

        $search = $this->nbJobList->with(['user' => function ($q) {
                $q->select('id', 'name', 'avatar');
            }])
            ->with(['nation' => function ($q) {
                $q->select('id', 'name');
            }])
            ->whereHas('user', function ($query) {
                $query->where([
                    'block' => self::UN_BLOCK,
                    'status' => self::ACTIVE
                ]);
            })
            ->where('deleted',self::INACTIVE)
            ->where('status',self::ACTIVE)
            ->where('isPublic',self::ACTIVE)
            ->where($conditions)
            ->orderBy('highlight_job', 'created_at', 'DESC')
            ->get();

        if($search) {
            return [
                'status'=> 200,
                'message' => 'Thành công',
                'data' => $search
            ];
        }

        return [
            'status'=> 400,
            'message' => 'Lỗi',
            'data' => null
        ];
    }
}
