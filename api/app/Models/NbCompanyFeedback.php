<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbCompanyFeedback extends Model
{
    protected $table = 'nb_company_feedbacks';

    public $fillable = [
        'company_id',
        'name_feed',
        'email_feed',
        'content_feed',
        'rate_feed',
        'user_id',
        'approve_feed'
    ];
    public function nbCompany(){
        return $this->belongsTo('App\Models\NbCompanyInfo','company_id');
    }
}
