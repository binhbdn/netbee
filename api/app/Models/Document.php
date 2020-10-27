<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = 'document';

    public $fillable = [
        'title',
        'content',
        'status',
        'file_upload',
        'link_document',
        'count_download',
        'thumbnail',
        'id_user'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id_user');
    }
}
