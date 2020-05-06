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
}
