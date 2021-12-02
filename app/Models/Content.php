<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Content extends Model
{
    protected $fillable = ['description', 'question','answer','theme_id','image'];


    public function theme()
    {
        return $this->belongsTo('App\Models\Theme');
    }
}
