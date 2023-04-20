<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessengerController extends Controller
{
    public function index(){
        $users = Auth::user()->messagefromWho()->get();
        return view('messenger.index', ['users' => $users]);
    }

    public function show(User $user){
        $users = Auth::user()->messagefromWho()->get();
        $message = DB::table('messenger')->orderBy('created_at', 'ASC')->get();
        return view('messenger.show', ['message' => $message, 'user' => $user, 'users' => $users]);
    }

    public function store(Request $request){
        $validated = $request->validate([
            'message_text' => 'max: 300',
            'message_img' => 'image | mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=200,min_height=200,max_width=4000,max_height=4000',
        ]);


        if ($request->message_img){
            $fileName = time().$request->file('message_img')->getClientOriginalName();
            $image_path = $request->file('message_img')->storeAs('messenger', $fileName, 'public');
            $validated['message_img'] = '/storage/'.$image_path;
        }


        Auth::user()->messagefromWho()->attach($request->input('messageto_id'), ['message_text' => $validated['message_text'], 'message_img' => $validated['message_img']]);
        return back();
    }
}
