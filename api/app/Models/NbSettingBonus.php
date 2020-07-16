<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbSettingBonus extends Model
{
    protected $table = 'nb_setting_bonus';

    public $fillable = [
        'percent_bonus',
        'status'
    ];

}