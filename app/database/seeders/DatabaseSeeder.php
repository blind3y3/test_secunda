<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Building\Model\Building;
use Modules\Organization\Model\Organization;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(
            ActivitySeeder::class,
            BuildingNearestCoordsSeeder::class,
        );

        Building::factory()
            ->count(10)
            ->has(Organization::factory()->count(10))
            ->create();
    }
}
