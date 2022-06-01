<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Videogame;
use Illuminate\Auth\Access\HandlesAuthorization;

class VideogamePolicy
{
    use HandlesAuthorization;


    public function delete(User $user, Videogame $videogame)
    {
        return $user->id === $videogame->user_id;
    }
}
