<?php

namespace Tests\Feature\Actions;

use App\Actions\GetUserByIdAction;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Tests\TestCase;

class GetUserByIdActionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws UserNotFoundException
     */
    public function test_run()
    {
        $user1 = User::factory()->create();
        $this->assertUser($user1);

        $user2 = User::factory()->withCar()->create();
        $this->assertUser($user2);

    }

    /**
     * @throws UserNotFoundException
     */
    private function assertUser(User $user): void
    {
        $result = app(GetUserByIdAction::class)->run($user->id);

        $this->assertEquals(
            $user->toArray(),
            $result->toArray()
        );
    }
}
