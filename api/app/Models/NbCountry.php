<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbCountry extends Model
{
    protected $table = 'nb_country';

    public $fillable = [
        'countryName',
        'countryCame'
    ];
}
