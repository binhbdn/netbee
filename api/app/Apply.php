<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = 'apply';
    protected $primaryKey = 'id';
    protected $fillable = ['job_id', 'user_create', 'file_cv', 'name', 'email', 'phone', 'status', 'created_at', 'updated_at'];
}
