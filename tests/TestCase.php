<?php

namespace Tests;

use App\Models\Role;
use App\Models\Status;
use App\Models\StatusType;
use App\Models\Person;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Hash;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seedReferenceData();
    }

    protected function createAdminUser(array $overrides = []): User
    {
        $statusId = Status::query()->orderBy('id')->value('id');
        $roleId = Role::query()->orderBy('id')->value('id');

        $person = Person::create([
            'names' => $overrides['person_names'] ?? 'Admin',
            'surnames' => $overrides['person_surnames'] ?? 'User',
        ]);

        return User::factory()->create(array_merge([
            'name' => $person->full_name,
            'email' => $overrides['email'] ?? 'admin+' . uniqid() . '@example.com',
            'password' => Hash::make($overrides['password'] ?? 'password'),
            'person_id' => $person->id,
            'status_id' => $overrides['status_id'] ?? $statusId,
            'role_id' => $overrides['role_id'] ?? $roleId,
        ], $overrides));
    }

    protected function seedReferenceData(): void
    {
        $statusType = StatusType::firstOrNew(['id' => 1]);
        $statusType->name = $statusType->name ?? 'Account';
        $statusType->save();

        $status = Status::firstOrNew(['id' => 1]);
        $status->name = $status->name ?? 'Activo';
        $status->order = $status->order ?? 1;
        $status->status_type_id = $status->status_type_id ?? $statusType->id;
        $status->save();

        $role = Role::firstOrNew(['id' => 1]);
        $role->name = $role->name ?? 'Admin';
        $role->save();
    }
}
