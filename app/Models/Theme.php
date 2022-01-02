<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Theme extends Model
{
    //Campos de la tabla Theme
    protected $fillable = ['title','description','difficulty','advance'];

    //Funciones correspondientes al modelo Theme

    public function contents()
    {
        return $this->hasMany('App\Models\Content');
    }

    public function themes()
    {
        return $this->hasMany('App\Models\AchievementDetail');
    }

    public function details()
    {
        return $this->hasMany('App\Models\ContentDetail');
    }

}

