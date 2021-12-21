<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Achievement extends Model
{
    protected $fillable = ['title', 'description','image'];

   // public static function boot()
    //{
      //  parent::boot();
       // static::creating(function ($achievement) {
         //   $achievement->user_id = Auth::id();
        //});
    //}

    public function achievemnts()
    {
        return $this->hasMany('App\Models\AchievementDetail');
    }
}
