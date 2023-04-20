<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscribeController extends Controller
{
    public function subscribe(User $user){
        Auth::user()->whoSubscribed()->toggle($user->id);

        return back();
    }

}
