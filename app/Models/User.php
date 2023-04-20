<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'firstname',
        'surname',
        'username',
        'email',
        'password',
        'profile_img',
        'verified',
        'is_active',
    ];

    public function posts(){
        return $this->hasMany(Post::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function likedPosts(){
        return $this->belongsToMany(Post::class)
            ->withTimestamps();
    }

    public function complainPosts(){
        return $this->belongsToMany(Post::class, 'complains')
            ->withPivot('explanation')
            ->withTimestamps();
    }

    public function whoSubscribed(){
        return $this->belongsToMany(User::class, 'subscriptions', 'who_id', 'whom_id')
            ->withTimestamps();
    }
    public function whomSubscribed(){
        return $this->belongsToMany(User::class, 'subscriptions', 'whom_id', 'who_id')
            ->withTimestamps();
    }


    public function check(){
        return $this->hasOne(Check::class);
    }


    //messenger

    public function messagefromWho(){
        return $this->belongsToMany(User::class, 'messenger', 'messagefrom_id', 'messageto_id')
            ->withPivot('message_text', 'message_img')
            ->withTimestamps();
    }

    public function messageTo(){
        return $this->belongsToMany(User::class, 'messenger', 'messageto_id', 'messagefrom_id')
            ->withPivot('message_text', 'message_img')
            ->withTimestamps();
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
