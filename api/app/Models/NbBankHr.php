<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbBankHr extends Model
{
    protected $table = 'nb_bank_hr';
    public $timestamps = true;
    public $fillable = [
        'id_user',
        'name',
        'stk',
        'branch',
        'bankName'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }

}
