<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ThemeDetail extends Model
{
    use HasFactory;

    //Campos de la tabla Theme
    protected $fillable = ['user_id','theme_id','theme_advance'];

    //Función para determinar la autorización del usuario
    public static function boot()
    {
        parent::boot();
        static::creating(function ($detail) {
            $detail->user_id = Auth::id();
        });
    }

    //Funciones correspondientes al modelo ThemeDetail

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function themes()
    {
        return $this->belongsTo('App\Models\Theme');
    }
}
