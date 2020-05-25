<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = 'nb_applies';

    public $fillable = [
        'job_id',
        'user_id_submit',
        'user_id_recever',
        'cv_file',
        'cv_id',
        'name',
        'bonus',
        'interview_schedules',
        'status',
        'reason_for_rejection',
    ];

    public function job(){
        return $this->belongsTo('App\Models\NbJoblist', 'job_id');
    }
    public  function user()
    {
        return $this->belongsTo('App\User', 'user_id_recever');
    }
    public  function nbPaper()
    {
        return $this->belongsTo('App\Models\NbPaper','id','apply_id');
    }
    public  function nbCreateCall()
    {
        return $this->belongsTo('App\Models\NbCreateCall','id','id_applies');
    }
}
