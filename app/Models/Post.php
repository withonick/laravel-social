<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['message', 'img', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function likedUsers(){
        return $this->belongsToMany(User::class)
            ->withTimestamps();
    }

    public function complainUsers(){
        return $this->belongsToMany(User::class, 'complains')
            ->withPivot('explanation')
            ->withTimestamps();
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
