<?php

declare(strict_types=1);

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Phone\Model\Phone;

class PhoneFactory extends Factory
{
    protected $model = Phone::class;

    public function definition(): array
    {
        return [
            'number' => $this->faker->phoneNumber(),
        ];
    }
}
