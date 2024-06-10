<?php

namespace App\Policies;

use App\Models\Torneo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TorneoPolicy
{
    use HandlesAuthorization;

    public function before(User $user, $ability)
    {
        if ($user->role === 'admin') {
            return true;
        }
    }

    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, Torneo $torneo)
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, Torneo $torneo)
    {
        return $user->role === 'admin';
    }
}
