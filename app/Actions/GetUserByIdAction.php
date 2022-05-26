<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class GetUserByIdAction
{
    /**
     * @throws UserNotFoundException
     */
    public function run($id): User
    {
        $user = User::find($id);

        if(!$user) throw new UserNotFoundException();

        return $user;
    }
}
