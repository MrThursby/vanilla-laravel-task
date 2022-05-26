<?php

namespace Database\Factories;

use App\Models\Car;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    public function definition(): array
    {
        $updated_at = now()->subMonths(rand(0, 12));
        $created_at = (new Carbon($updated_at))->subMonths(rand(0, 24));

        return [
            'name' => $this->faker->name(),
            'car_id' => null,
            'created_at' => $created_at,
            'updated_at' => $updated_at
        ];
    }

    public function withCar(): Factory
    {
        return $this->state(function () {
            return [
                'car_id' => Car::factory()->create()->getAttribute('id'),
            ];
        });
    }
}
