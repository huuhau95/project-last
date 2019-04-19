<?php

namespace App\Policies;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function view(User $user)
    {
        return TRUE;
    }

    /**
    * Determine whether the user can create posts.
    *
    * @param  \App\User  $user
    * @return mixed
    */
    public function cud()
    {
        return Auth::user()->role_id == 1;
    }
}
