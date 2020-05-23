<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbHistoryCall extends Model
{
    protected $table = 'nb_history_call';
    public $timestamps = true;
    public $fillable = [
        'id_user',        
        'id_room',
        'action'
    ];
    
    public  function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }    
}
