<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Content extends Model
{
    //Campos de la tabla Content
    protected $fillable = ['description', 'question','answer_1','answer_2','answer_3','answer_4', 'feedback','theme_id','image'];

    //Funciones correspondientes al modelo Content

    public function theme()
    {
        return $this->belongsTo('App\Models\Theme');
    }

    public function contents()
    {
        return $this->hasMany('App\Models\AchievementDetail');
    }

    public function details()
    {
        return $this->hasMany('App\Models\ContentDetail');
    }

}
