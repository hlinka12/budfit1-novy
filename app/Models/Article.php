<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    public function user(){
        return $this->belongsTo('App\Models\User');
    }
    
    public function commentsArticle(){
        return $this->hasMany('App\Models\comment')->orderBy('created_at','desc');
    }

    public function liked(User $user){
        return $this->likes->contains('user_id', $user->id);
    }

    public function likes(){
        return $this->hasMany('App\Models\like');
    }
}
