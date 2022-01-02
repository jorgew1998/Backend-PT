<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AchievementDetail extends Model
{
    //Campos de la tabla AchievementDetail
    protected $fillable = ['achievement_id', 'user_id','theme_id', 'content_id'];

    //Función para determinar la autorización del usuario
    public static function boot()
    {
      parent::boot();
      static::creating(function ($detail) {
      $detail->user_id = Auth::id();
      });
    }

    //Funciones correspondientes al modelo AchievementDetail

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function achievements()
    {
        return $this->belongsTo('App\Models\Achievement');
    }

    public function themes()
    {
        return $this->belongsTo('App\Models\Theme');
    }

    public function contents()
    {
        return $this->belongsTo('App\Models\Content');
    }

}
