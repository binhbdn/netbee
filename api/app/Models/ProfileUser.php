<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileUser extends Model
{
    protected $table = 'nb_cvs';

    public $fillable = [
        'id_user',
        'fullname_profile',
        'birthday_profile',
        'maleFemale',
        'address_profile',
        'phone_profile',
        'email_profile',
        'cmnd_profile',
        'note_profile',
        'title_target_profile',
        'note_target_profile',
        'skill_communication_profile',
        'skill_information_profile',
        'skill_logic_profile',
        'certificate_profile',
        'level_education',
        'name_education',
        'specialized_education',
        'deleted',        
    ];
}
