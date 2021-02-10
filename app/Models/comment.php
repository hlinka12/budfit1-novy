<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    protected $fillable = [
        'user_id',
        'article_id'
    ];

    use HasFactory;
    public function userOwn(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function articleOwn(){
        return $this->belongsTo('App\Models\Article');
    }
}
