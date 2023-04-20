<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Post $post)
    {
        //
    }



    public function create(User $user)
    {
        //
    }

    public function update(User $user, Post $post)
    {
        return ($user->id == $post->user_id) || ($user->role->name == "moderator");
    }

    public function delete(User $user, Post $post)
    {
        return ($user->id == $post->user_id) || ($user->role->name == "moderator");
    }

    public function complain(User $user, Post $post){
        return($user->id != $post->user_id) || ($user->role->name == "user");
    }

    public function like(Post $post, User $user){
        return($user->id != $post->user_id);
    }


    public function restore(User $user, Post $post)
    {
        //
    }


    public function forceDelete(User $user, Post $post)
    {
        //
    }
}
