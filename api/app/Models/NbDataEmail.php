<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbDataEmail extends Model
{
    protected $table = 'nb_data_emails';

    public $fillable = [
        'name',
        'phone',
        'email'
    ];
}
