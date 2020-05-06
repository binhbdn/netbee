<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'cvs';

    public $fillable = [
        'name',
        'email',
        'phone',
        'nation',
        'address',
        'apply_type',
        'cv_file',
        'description',
        'language_rank',
        'title'
    ];
}
