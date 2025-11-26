<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function create()
    {
      return Auth::check();
    }

    public function delete(User $user, Post $post)
    {
      return $user->id == $post->id_creator && $user->id == Auth::user()->id;
    }

    public function edit(User $user, Post $post)
    {
      return $user->id == $post->id_creator && $user->id == Auth::user()->id;
    }

}
