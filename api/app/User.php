<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fullname', 'email', 'password','level'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function nbJobs()
    {
        return $this->hasMany('App\Models\NbJoblist', 'id_created', 'id');
    }

    public function nbCompany()
    {
        return $this->hasOne('App\Models\NbCompanyInfo', 'company_id', 'id');
    }

    public function news()
    {
        return $this->hasMany('App\Models\News', 'user_created', 'id');
    }

    public function companyFeedback(){
        return $this->hasMany('App\Models\NbCompanyFeedback','user_id');
    }
}
