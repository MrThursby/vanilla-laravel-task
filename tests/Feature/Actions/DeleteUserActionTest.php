<?php

namespace Tests\Feature\Actions;

use App\Actions\DeleteUserAction;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Tests\TestCase;

class DeleteUserActionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     * @throws UserNotFoundException
     */
    public function test_run()
    {
        $user = User::factory()->create();

        $result = app(DeleteUserAction::class)->run($user->id);

        $this->assertTrue($result);
        $this->assertDatabaseMissing('users', ['name' => $user->name, 'id' => $user->id]);
    }
}
