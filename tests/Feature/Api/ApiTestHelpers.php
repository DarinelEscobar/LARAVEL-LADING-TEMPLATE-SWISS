<?php

use App\Models\Person;
use App\Models\Role;
use App\Models\Status;
use App\Models\StatusType;
use App\Models\User;
use Illuminate\Support\Str;
use Laravel\Sanctum\Sanctum;

function ensureApiReferenceData(): array
{
    $statusType = StatusType::firstOrCreate(
        ['id' => 1],
        ['name' => 'Account']
    );

    $status = Status::firstOrCreate(
        ['id' => 1],
        ['name' => 'Activo', 'status_type_id' => $statusType->id, 'order' => 1]
    );

    $role = Role::firstOrCreate(
        ['id' => 1],
        ['name' => 'Admin']
    );

    return [$status, $role];
}

function makePersonRecord(array $overrides = []): Person
{
    return Person::create(array_merge([
        'names' => 'Test ' . Str::random(5),
        'surnames' => 'User ' . Str::random(5),
    ], $overrides));
}

function makeUserForApi(array $overrides = []): User
{
    [$status, $role] = ensureApiReferenceData();
    $person = makePersonRecord();

    return User::factory()->create(array_merge([
        'person_id' => $person->id,
        'status_id' => $status->id,
        'role_id' => $role->id,
    ], $overrides));
}

function authenticateAsAdmin(): User
{
    $admin = makeUserForApi([
        'email' => 'admin+' . Str::random(4) . '@test.com',
    ]);

    Sanctum::actingAs($admin, ['*'], 'sanctum');

    return $admin;
}
