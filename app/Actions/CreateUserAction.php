<?php

namespace App\Actions;

use App\Models\User;

class CreateUserAction
{
    public function run(string $name, int $car_id = null): int
    {
        $user = User::query()->create(compact('name', 'car_id'));
        return $user->getAttribute('id');
    }
}
