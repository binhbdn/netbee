<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FailedJob extends Model
{
    protected $table = 'failed_jobs';

    public $fillable = [
        'connection',
        'queue',
        'payload',
        'exception',
        'failed_at',
    ];
}
