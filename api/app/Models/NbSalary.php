<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbSalary extends Model
{
    protected $table = 'nb_salary';

    public $fillable = [
        'salary'
    ];
}
