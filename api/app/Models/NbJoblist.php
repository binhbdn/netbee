<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbJoblist extends Model
{
    protected $table = 'nb_joblists';
    public $timestamps = true;
    public $fillable = [
        'type',
        'nation_id',
        'id_created',
        'status',
        'title',
        'id_visa',
        'request',
        'quantity',
        'currency',
        'work_form',
        'age_start',
        'age_late',
        'salary_start',
        'salary_end',
        'salary_status',
        'subsidy',
        'date_start',
        'date_test',
        'expiration_date',
        'expected_date',
        'workplace',
        'bonus',
        'time_bonus',
        'highlight_job',
        'school_name',
        'deleted',
        'isPublic',
        'isDraft',
        'time_contract',
        'height',
        'weight',
        'academicLevel',
        'insurrance',
        'skin',
        'dormitory',
        'meal',
        'startTimeLabor',
        'endTimeLabor',
        'allowance',
        'benefits',
        'job_description',
        'route'
    ];

    public function Apply()
    {
        return $this->hasMany('App\Models\Apply', 'id');
    }

    public function nation()
    {
        return $this->belongsTo('App\Models\Nation');
    }

    public  function visa_profession()
    {
        return $this->belongsTo('App\Models\VisaProfession', 'id_visa');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'id_created');
    }

    public function nbCompany(){
        return $this->belongsTo('App\Models\NbCompanyInfo','id_created','company_id');
    }
    
    public function nbJobSave()
    {
        return $this->hasMany('App\Models\NbJobSave', 'id_job', 'id');
    }
}
