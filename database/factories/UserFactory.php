<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $person = Person::query()->first() ?? Person::create([
            'names' => 'Test Person',
            'surnames' => 'Factory',
        ]);

        $statusId = Status::find(1)?->id ?? Status::query()->orderBy('id')->value('id') ?? 1;
        $roleId = Role::find(1)?->id ?? Role::query()->orderBy('id')->value('id') ?? 1;

        return [
            'name' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => fake()->password(),
            'remember_token' => fake()->word(),
            'person_id' => $person->id,
            'status_id' => $statusId,
            'role_id' => $roleId,
        ];
    }
}
