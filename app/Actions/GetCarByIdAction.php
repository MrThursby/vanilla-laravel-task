<?php

namespace App\Actions;

use App\Exceptions\CarNotFoundException;
use App\Models\Car;

class GetCarByIdAction
{
    /**
     * @throws CarNotFoundException
     */
    public function run($id): Car
    {
        $car = Car::find($id);

        if(!$car) throw new CarNotFoundException();

        return $car;
    }
}
