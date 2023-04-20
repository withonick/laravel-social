<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    protected $fillable = ['user_id', 'passport', 'article'];

    public function user(){
        return $this->hasOne(User::class);
    }

    use HasFactory;
}
