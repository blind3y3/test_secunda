<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Activity\Model\Activity;
use Modules\Organization\Model\Organization;
use Modules\Phone\Model\Phone;

class OrganizationFactory extends Factory
{
    protected $model = Organization::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Organization $organization) {
            $activities = Activity::inRandomOrder()->limit(rand(1, 3))->pluck('id');
            $organization->activities()->attach($activities);

            Phone::factory()->count(rand(1, 3))->create([
                'organization_id' => $organization->id,
            ]);
        });
    }
}
