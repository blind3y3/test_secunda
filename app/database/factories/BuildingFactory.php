<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Building\Model\Building;

class BuildingFactory extends Factory
{
    protected $model = Building::class;

    public function definition(): array
    {
        return [
            'address'   => $this->faker->address(),
            'latitude'  => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
