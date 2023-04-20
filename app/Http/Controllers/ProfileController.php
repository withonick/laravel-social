<?php

namespace App\Http\Controllers;

use App\Models\Check;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show(User $user){
            if(Auth::check() && $user->id == Auth::user()->id){
                $user = Auth::user();
                return view('profile.myprofile', ['user' => $user]);
            }
            else{
                return view('profile.show', ['user' => $user]);
            }
    }

    public function edit(User $user){
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request){
        $validated = $request->validate([
            'firstname' => 'required | max: 255',
            'surname' => 'required | max: 255',
            'username' => 'required | max: 255',
            'email' => 'required | email',
        ]);

        Auth::user()->update($validated);

        return back();
    }

    public function updateimg(Request $request){
        $user = Auth::user();
        $validated = $request->validate([
            'profile_img' => 'required | image | mimes:jpg,png,jpeg,gif,svg|max:4020|dimensions:min_width=200,min_height=200,max_width=4000,max_height=4000',
        ]);

        $fileName = time().$request->file('profile_img')->getClientOriginalName();
        $image_path = $request->file('profile_img')->storeAs('profile', $fileName, 'public');

        $validated['profile_img'] = '/storage/'.$image_path;

        $user->update($validated);

        return back();
    }

    public function verify(Request $request){
        $validated = $request->validate([
            'passport' => 'required | image | mimes:jpg,png,jpeg,gif,svg|max:4020|dimensions:min_width=200,min_height=200,max_width=4000,max_height=4000',
            'article' => 'required',
            'user_id' => 'required | numeric | exists:users,id',
        ]);

        $fileName = time().$request->file('passport')->getClientOriginalName();
        $image_path = $request->file('passport')->storeAs('verify', $fileName, 'public');

        $validated['passport'] = '/storage/'.$image_path;

        Check::create($validated);

        return back();
    }

    public function addMoney(Request $request){
        $validated = $request->validate([
            'balance' => 'required | numeric',
        ]);

        Auth::user()->increment('balance', $validated['balance']);

        return back()->with('message', 'Вы пополнили баланс');
    }

    public function buy(User $user){
        if ($user->balance >= 2300){
            $user->decrement('balance', 2300);
            $user->update([
                'verified' => true
            ]);

            return redirect()->route('profile.show', $user->id)->with('Вы успешно купили подписку на месяц');
        }

        return back()->with('message', 'У вас недостаточно денег');
    }
}
