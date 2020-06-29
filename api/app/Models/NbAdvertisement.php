<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbAdvertisement extends Model
{
    protected $table = 'nb_advertisement';

    public $fillable = [
        'name',
        'picture',
        'status',
        'deleted'
    ];

}