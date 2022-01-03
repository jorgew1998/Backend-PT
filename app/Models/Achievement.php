<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Achievement extends Model
{
    //Campos de la tabla Achievement
    protected $fillable = ['title', 'item_1', 'item_2', 'item_3', 'item_4','image'];

    //Funciones correspondientes al modelo Achievement
    public function achievemnts()
    {
        return $this->hasMany('App\Models\AchievementDetail');
    }

}
