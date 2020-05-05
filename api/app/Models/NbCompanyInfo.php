<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbCompanyInfo extends Model
{
    protected $table = 'nb_companies_info';

    public $fillable = [
        'company_id',
        'company_hotline',
        'company_about',
        'company_tax',
        'company_benefit',
        'comnpany_policy',
        'company_chance',
        'company_link',
        'company_verify'
    ];
}
