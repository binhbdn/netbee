<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbEmailCompany extends Model
{
    protected $table = 'nb_email_company';

    public $fillable = [
        'id_company',
        'email_company',
        'status'
    ];

}