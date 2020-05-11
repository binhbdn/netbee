<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = 'nb_applies';

    public $fillable = [
        'job_id',
        'user_id',
        'cv_file',
        'cv_id',
        'name',
        'bonus',
        'interview_schedules',
        'status',
        'reason_for_rejection',
    ];

    public function Jobs(){
        return $this->belongsTo('App\Models\NbJoblist', 'job_id');
    }
}
