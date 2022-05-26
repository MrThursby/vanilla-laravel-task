<?php

namespace Tests\Feature\Actions;

use App\Actions\CreateCarAction;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateCarActionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_run()
    {
        $car = Car::factory()->make();

        $result = app(CreateCarAction::class)->run($car->title);

        $this->assertTrue(is_integer($result));
        $this->assertDatabaseHas('cars', ['title' => $car->title, 'id' => $result]);
    }
}
