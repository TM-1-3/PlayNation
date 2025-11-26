<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function edit(User $user)
    {
        return $user->id == Auth::user()->id;
    }

    public function delete(User $user) {
        return $user->id == Auth::user()->id;
    }
}
