<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ContentDetail extends Model
{

    protected $fillable = ['content_id','user_id','theme_id','date'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($detail) {
            $detail->user_id = Auth::id();
        });
    }

    use HasFactory;



    public function users()
    {
        return $this->belongsTo('App\Models\User');
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
