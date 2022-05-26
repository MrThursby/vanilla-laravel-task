<?php

namespace Tests\Feature\Actions;

use App\Actions\UpdateCarAction;
use App\Exceptions\CarNotFoundException;
use App\Models\Car;
use Tests\TestCase;

class UpdateCarActionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws CarNotFoundException
     */
    public function test_run()
    {
        $car = Car::factory()->create();
        $new_car = Car::factory()->make();

        $result = app(UpdateCarAction::class)->run($car->id, $new_car->title);

        $this->assertTrue($result);
        $this->assertDatabaseHas('cars', [
            'title' => $new_car->title,
            'id' => $car->id
        ]);
    }
}
