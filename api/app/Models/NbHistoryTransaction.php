<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbHistoryTransaction extends Model
{
    protected $table = 'nb_history_transactions';

    public $fillable = [
        'id_user_payment',
        'content',
        'using_discount',
        'price'
    ];
}
