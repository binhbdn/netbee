<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogViewNew extends Model
{
    protected $table = 'log_view_news';

    public $fillable = [
        'ip',
        'news_id'
    ];
}
