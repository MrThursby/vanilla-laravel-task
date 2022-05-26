<?php

namespace Tests\Feature\Actions;

use App\Actions\DeleteCarAction;
use App\Exceptions\CarNotFoundException;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCarActionTest extends TestCase
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

        $result = app(DeleteCarAction::class)->run($car->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('cars', ['title' => $car->title, 'id' => $car->id]);
    }
}
