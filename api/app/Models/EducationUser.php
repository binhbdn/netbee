<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationUser extends Model
{
    protected $table = 'education_user';

    public $fillable = [
        'id_profile_user',
        'name_education',
        'learning_education',
        'business_education',
        'from_datetime_education',
        'to_datetime_education',
        'deleted',              
    ];
}
