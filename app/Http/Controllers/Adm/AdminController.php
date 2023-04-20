<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\Controller;
use App\Models\Check;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        return view('adm.index', ['users' => User::all(), 'posts' => Post::all(), 'comments' => Comment::all()]);
    }

    public function users(){
        return view('adm.users.index', ['users' => User::all()]);
    }

    public function posts(){
        return view('adm.posts.index', ['posts' => Post::all()]);
    }

    public function complains(){
        $complains = User::all()->complainPosts()->get();
        return view('adm.complains.index', ['complains' => $complains]);
    }

    public function confirm(){
        return view('adm.users.confirm', ['users' => Check::all()]);
    }
}
