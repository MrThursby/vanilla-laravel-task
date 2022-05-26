<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Car;
use Tests\TestCase;

class CarControllerTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this->getJson('/api/cars');

        $response
            ->assertJsonCount(Car::query()->count(), 'data')
            ->assertOk();
    }

    public function test_store(): void
    {
        $car = Car::factory()->make();

        $response = $this->postJson('/api/cars', $car->toArray());
        $response->assertCreated();

        $this->assertDatabaseHas('cars', $car->toArray());
    }

    public function test_show(): void
    {
        $car = Car::factory()->create();

        $response = $this->getJson('/api/cars/' . $car->getAttribute('id'));

        $response
            ->assertOk()
            ->assertJsonFragment($car->toArray());
    }

    public function test_update(): void
    {
        $car = Car::factory()->create();
        $new_car = Car::factory()->make();

        $response = $this->putJson('/api/cars/' . $car->getAttribute('id'), $new_car->toArray());

        $response->assertOk();
        $this->assertDatabaseHas('cars', [
            'id' => $car->getAttribute('id'),
            ...$new_car->toArray()
        ]);
    }

    public function test_destroy(): void
    {
        $car = Car::factory()->create();

        $response = $this->deleteJson('/api/cars/' . $car->getAttribute('id'));
        $response->assertOk();

        $this->assertDatabaseMissing('cars', $car->toArray());
    }
}
