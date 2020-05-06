<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nation extends Model
{
    protected $table = 'nations';

    public $fillable = [
        'name',
        'description'
    ];
}
