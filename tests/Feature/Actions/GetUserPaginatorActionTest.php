<?php

namespace Tests\Feature\Actions;

use App\Actions\GetUserPaginatorAction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetUserPaginatorActionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_run()
    {
        User::factory()->count(16)->create();

        ['data' => $data, 'meta' => $meta] = app(GetUserPaginatorAction::class)->run();

        $this->assertCount(15, $data);
        $this->assertEquals(16, $meta['total']);
        $this->assertIsArray($meta);
    }
}
