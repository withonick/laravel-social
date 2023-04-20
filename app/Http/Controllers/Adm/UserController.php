<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function ban(User $user){
        $user->update([
            'is_active' => false
        ]);

        return back()->with('message', 'User banned');
    }

    public function unban(User $user){
        $user->update([
            'is_active' => true
        ]);

        return back()->with('message', 'User unbanned');
    }
}
