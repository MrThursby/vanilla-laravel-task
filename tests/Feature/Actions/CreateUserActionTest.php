<?php

namespace Tests\Feature\Actions;

use App\Actions\CreateUserAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateUserActionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_run()
    {
        $user1 = User::factory()->make();
        $this->assertUser($user1);

        $user2 = User::factory()->withCar()->make();
        $this->assertUser($user2);
    }

    private function assertUser(User $user): void
    {
        $result = app(CreateUserAction::class)->run(
            $user->name,
            $user->car_id
        );

        $this->assertTrue(is_integer($result));
        $this->assertDatabaseHas('users', [
            'name' => $user->name,
            'car_id' => $user->car_id,
            'id' => $result
        ]);
    }
}
