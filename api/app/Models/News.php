<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';

    public $fillable = [
        'user_created',
        'title',
        'content',
        'short_content',
        'thuml',
        'status',
        'deleted',
        'id_category',
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_created', 'id');
    }
}
