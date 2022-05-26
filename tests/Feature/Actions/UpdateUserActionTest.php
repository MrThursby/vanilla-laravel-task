<?php

namespace Tests\Feature\Actions;

use App\Actions\UpdateUserAction;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
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
        $new_user = User::factory()->make();

        $result = app(UpdateUserAction::class)->run($user->id, $new_user->name, $new_user->id);

        $this->assertTrue($result);
        $this->assertDatabaseHas('users', [
            'name' => $new_user->name,
            'car_id' => $new_user->car_id,
            'id' => $user->id
        ]);
    }
}
