<?php

namespace App\Policies;

use App\Models\Tenista;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TenistaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Tenista $tenista)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Tenista $tenista)
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can view deleted models.
     */
    public function viewDeleted(User $user)
    {
        return $user->role === 'admin';
    }
}
