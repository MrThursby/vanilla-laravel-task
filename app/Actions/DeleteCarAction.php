<?php

namespace App\Actions;

use App\Exceptions\CarNotFoundException;
use App\Models\Car;

class DeleteCarAction
{
    /**
     * @throws CarNotFoundException
     */
    public function run(int $id): bool
    {
        $car = Car::find($id);

        if(!$car) throw new CarNotFoundException();

        return (bool) $car->delete();
    }
}
