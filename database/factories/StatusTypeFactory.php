<?php

namespace Database\Factories;

use App\Models\StatusType;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusTypeFactory extends Factory
{
    protected $model = StatusType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(),
        ];
    }
}
