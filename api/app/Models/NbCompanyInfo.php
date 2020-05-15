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
        'company_verify',
        'image_cover',
        'username'
    ];

    public function user(){
        return $this->hasOne('App\User','id','company_id');
    }

    public function companyFeedback(){
        return $this->hasMany('App\Models\NbCompanyFeedback','company_id');
    }
    public function nation(){
        return $this->belongsTo('App\Models\Nation','nation_id');
    }
}
