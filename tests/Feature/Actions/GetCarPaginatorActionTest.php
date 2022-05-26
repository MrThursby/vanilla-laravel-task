<?php

namespace Tests\Feature\Actions;

use App\Actions\GetCarPaginatorAction;
use App\Models\Car;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GetCarPaginatorActionTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_run()
    {
        Car::factory()->count(16)->create();

        ['data' => $data, 'meta' => $meta] = app(GetCarPaginatorAction::class)->run();

        $this->assertCount(15, $data);
        $this->assertEquals(16, $meta['total']);
        $this->assertIsArray($meta);
    }
}
