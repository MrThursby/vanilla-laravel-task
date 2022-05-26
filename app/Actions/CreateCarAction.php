<?php

namespace App\Actions;

use App\Models\Car;

class CreateCarAction
{
    public function run($title): int
    {
        $car = Car::query()->create(compact('title'));
        return $car->getAttribute('id');
    }
}
