<?php

namespace Database\Factories;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatusFactory extends Factory
{
    protected $model = Status::class;

    public function definition(): array
    {
        $statusType = StatusType::query()->first() ?? StatusType::factory()->create();

        return [
            'name' => $this->faker->word(),
            'order' => $this->faker->numberBetween(1, 10),
            'status_type_id' => $statusType->id,
        ];
    }
}
