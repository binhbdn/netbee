<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbCompanyFollows extends Model
{
    //
    protected $table = "nb_company_follows";
    protected $primaryKey = "id";
    protected $fillable = [
        'id',
        'company_id',
        'user_id',
        'created_at',
        'updated_at'
    ];


}
