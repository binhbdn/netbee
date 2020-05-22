<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbCreateCall extends Model
{
    protected $table = 'nb_create_call';
    public $timestamps = true;
    public $fillable = [
        'id_user',
        'id_applies',
        'id_room',
        'idjob'
    ];

    public function Apply()
    {
        return $this->belongsTo('App\Models\Apply', 'id_applies');
    }

    public function nbjob()
    {
        return $this->belongsTo('App\Models\NbJoblist','idjob');
    }
  
    public  function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }    
}
