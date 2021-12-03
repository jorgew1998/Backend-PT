<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Content extends Model
{
    protected $fillable = ['description', 'question','answer_1','answer_2','answer_3','answer_4', 'feedback','theme_id','image'];


    public function theme()
    {
        return $this->belongsTo('App\Models\Theme');
    }
}
