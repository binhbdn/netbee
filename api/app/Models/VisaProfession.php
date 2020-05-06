<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaProfession extends Model
{
    protected $table = 'visa_profession';

    public $fillable = [
        'profession'
    ];
}
