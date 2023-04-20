<?php

namespace App\Http\Controllers\Authorization;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'firstname' => 'required | string | max: 255',
            'surname' => 'required | string | max: 255',
            'username' => 'required | string | max: 255 | unique:users',
            'email' => 'required | email | max: 255 | unique:users',
            'password' => 'required | min: 6 | confirmed',
            'profile_img' => 'required | image | mimes:jpg,png,jpeg,gif,svg|max:4020|dimensions:min_width=200,min_height=200,max_width=4000,max_height=4000',
        ]);

        $fileName = time().$request->file('profile_img')->getClientOriginalName();
        $image_path = $request->file('profile_img')->storeAs('profile', $fileName, 'public');

        $validated['profile_img'] = '/storage/'.$image_path;

        $user = User::create([
            'firstname' => $request->input('firstname'),
            'surname' => $request->input('surname'),
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'profile_img' => $validated['profile_img'],
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }
}
