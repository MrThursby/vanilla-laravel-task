<?php

namespace App\Actions;

use App\Exceptions\CarNotFoundException;
use App\Models\Car;

class UpdateCarAction
{
    /**
     * @throws CarNotFoundException
     */
    public function run(int $id, $title): bool
    {
        $car = Car::find($id);

        if(!$car) throw new CarNotFoundException();

        return $car->update(compact('title'));
    }
}
