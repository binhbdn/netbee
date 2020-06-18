<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbTag extends Model
{
    protected $table = 'nb_tag';
    public $timestamps = true;
    public $fillable = [
        'tag_name',
        'status',
        'deleted',     
    ];  
}
