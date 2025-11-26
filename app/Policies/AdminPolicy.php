<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    public function show() {
        return Auth::user()->isAdmin();
    } 

    public function edit_user(User $user)
    {
        return Auth::check() && Auth::user()->isAdmin() && $user;
    }

    public function delete_user(User $user) {
        return Auth::user()->isAdmin() && $user;
    }

    public function create_user() {
        return Auth::user()->isAdmin();
    }

}