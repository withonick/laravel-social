<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post){
        $validated = $request->validate([
            'text' => 'max: 280',
            'post_id' => 'required | numeric | exists:posts,id',
            'comment_image' => 'image | mimes:jpg,png,jpeg,gif,svg|max:4020|dimensions:min_width=200,min_height=200,max_width=4000,max_height=4000',
        ]);

        if ($request->comment_image){
            $fileName = time().$request->file('comment_image')->getClientOriginalName();
            $image_path = $request->file('comment_image')->storeAs('comments', $fileName, 'public');

            $validated['comment_image'] = '/storage/'.$image_path;
        }

        Auth::user()->comments()->create($validated);

        return back()->with('message', 'Hello world!');
    }
}
