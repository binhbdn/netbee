<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCv extends Model
{
    protected $table = 'user_cvs';

    public $fillable = [
        'status',
        'cv_id',
        'user_id'
    ];
}
