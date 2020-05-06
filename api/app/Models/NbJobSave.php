<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbJobSave extends Model
{
    protected $table = 'nb_job_saves';

    public $fillable = [
        'id_job',
        'id_saver'
    ];
}
