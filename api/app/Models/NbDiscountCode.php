<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbDiscountCode extends Model
{
    protected $table = 'nb_discount_code';

    public $fillable = [
        'code',
        'status',
        'discount'
    ];
}
