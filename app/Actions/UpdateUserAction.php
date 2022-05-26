<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class UpdateUserAction
{
    /**
     * @throws UserNotFoundException
     */
    public function run(int $id, string $name, int $car_id = null): bool
    {
        $user = User::find($id);

        if(!$user) throw new UserNotFoundException();

        return $user->update(compact('name', 'car_id'));
    }
}
