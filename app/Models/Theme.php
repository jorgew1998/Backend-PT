<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Theme extends Model
{
    protected $fillable = ['title', 'difficulty','advance'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($theme) {
            $theme->user_id = Auth::id();
        });
    }

    public function contents()
    {
        return $this->hasMany('App\Models\Content');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}

