<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'message' => 'max: 280',
            'img' => 'image | mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=200,min_height=200,max_width=4000,max_height=4000',
        ]);
        if($request->img){
            $fileName = time().$request->file('img')->getClientOriginalName();
            $image_path = $request->file('img')->storeAs('posts', $fileName, 'public');

            $validated['img'] = '/storage/'.$image_path;
        }

        Auth::user()->posts()->create($validated);

        return back()->with('message', 'Пост создан');
    }

    public function complainform(Post $post){
        return view('posts.complain', ['post' => $post]);
    }

    public function complain(Request $request, Post $post){
        $validated = $request->validate([
            'explanation' => 'required'
        ]);

        $compainPost = Auth::user()->complainPosts()->where('post_id', $request->post_id)->first();

        if($compainPost != null){
            Auth::user()->complainPosts()->detach($request->post_id, ['explanation' => $request->input('explanation')]);
        }
        else{
            Auth::user()->complainPosts()->attach($request->post_id, ['explanation' => $request->input('explanation')]);
        }

        return redirect()->route('index');

    }

    public function rate(Post $post){
        $commentRated = Auth::user()->likedPosts()->where('post_id', $post->id)->first();

        if($commentRated != null){
            Auth::user()->likedPosts()->toggle($post->id);
            $post->decrement('likes');
        }
        else{
            Auth::user()->likedPosts()->toggle($post->id);
            $post->increment('likes');
        }

        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'message' => 'required | max: 280',
            'img' => 'image | mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=200,min_height=200,max_width=4000,max_height=4000',
        ]);
        if ($request->img) {
            $fileName = time() . $request->file('img')->getClientOriginalName();
            $image_path = $request->file('img')->storeAs('posts', $fileName, 'public');

            $validated['img'] = '/storage/' . $image_path;
        }
        $post->update($validated);

        return redirect()->route('index');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('message', 'Post deleted');
    }
}
