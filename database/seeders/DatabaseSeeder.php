<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createCarsAndUsersWithoutRelations();
        $this->createCarsAndUsersWithRelations();
    }

    private function createCarsAndUsersWithoutRelations() {
        User::factory(10)->create();
        Car::factory(10)->create();
    }

    private function createCarsAndUsersWithRelations() {
        User::factory(10)->withCar()->create();
    }
}
