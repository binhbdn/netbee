<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbNotification extends Model
{
    protected $table = 'nb_notifications';

    public $fillable = [
        'content',
        'id_recever',
        'url',
        'status_notification'
    ];
}
