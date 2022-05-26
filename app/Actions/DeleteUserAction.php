<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class DeleteUserAction
{
    /**
     * @throws UserNotFoundException
     */
    public function run(int $id): bool
    {
        $user = User::find($id);

        if(!$user) throw new UserNotFoundException();

        return (bool) $user->delete();
    }
}
