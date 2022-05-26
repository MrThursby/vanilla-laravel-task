<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function test_index(): void
    {
        $response = $this->getJson('/api/users');

        $response
            ->assertJsonCount(User::query()->count(), 'data')
            ->assertOk();
    }

    public function test_store(): void
    {
        $user = User::factory()->withCar()->make();

        $response = $this->postJson('/api/users', $user->toArray());
        $response->assertCreated();

        $this->assertDatabaseHas('users', [
            'name' => $user->getAttribute('name'),
            'car_id' => $user->getAttribute('car_id')
        ]);
    }

    public function test_show(): void
    {
        $user = User::factory()->create();

        $response = $this->getJson('/api/users/' . $user->getAttribute('id'));

        $response
            ->assertJson(['data' => $user->toArray()])
            ->assertOk();
    }

    public function test_update(): void
    {
        $user = User::factory()->withCar()->create();
        $new_user = User::factory()->withCar()->make();

        $response = $this->putJson('/api/users/' . $user->getAttribute('id'), $new_user->toArray());

        $response->assertOk();
        $this->assertDatabaseHas('users', [
            'id' => $user->getAttribute('id'),
            'name' => $new_user->getAttribute('name'),
            'car_id' => $new_user->getAttribute('car_id')
        ]);
    }

    public function test_destroy(): void
    {
        $user = User::factory()->create();

        $response = $this->deleteJson('/api/users/' . $user->getAttribute('id'));
        $response->assertOk();

        $this->assertDatabaseMissing('users', $user->toArray());
    }
}
