<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NbPaper extends Model
{
    protected $table = 'nb_papers';

    public $fillable = [
        'front_id_card',
        'back_id_card',
        'health_certification',
        'high_school_diploma',
        'passport',
        'birth_certificate',
        'curriculum_vitae',
        'card_photo',
        'apply_id'
    ];

    public function apply(){
        return $this->belongsTo('App\Models\Apply', 'apply_id');
    }
}
