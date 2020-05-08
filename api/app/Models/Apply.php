<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = 'apply';

    public $fillable = [
        'job_id',
        'user_create',
        'cv',
        'name',
        'email',
        'phone',
        'status',
        'isPublic',
        'isDraft'
    ];

    public function Jobs(){
        return $this->belongsTo('App\Models\NbJoblist', 'job_id')->with('user');
    }
}
