<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbJobReport extends Model
{
    protected $table = 'nb_job_reports';

    public $fillable = [
        'id_job',
        'id_reporter',
        'content'
    ];
}
