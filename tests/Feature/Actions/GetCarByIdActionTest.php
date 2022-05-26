<?php

namespace Tests\Feature\Actions;

use App\Actions\GetCarByIdAction;
use App\Exceptions\CarNotFoundException;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCarByIdActionTest extends TestCase
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

        $result = app(GetCarByIdAction::class)->run($car->id);

        $this->assertEquals(
            $car->toArray(),
            $result->toArray()
        );
    }
}
