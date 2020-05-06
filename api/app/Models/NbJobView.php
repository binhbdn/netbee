<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbJobView extends Model
{
    protected $table = 'nb_job_views';

    public $fillable = [
        'id_job',
        'id_viewer'
    ];
}
