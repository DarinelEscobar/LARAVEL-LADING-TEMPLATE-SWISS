<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

beforeEach(function () {
    [$status, $role] = ensureApiReferenceData();
    $this->status = $status;
    $this->role = $role;

    authenticateAsAdmin();
});

it('lists users', function () {
    makeUserForApi(['email' => 'one@example.com']);
    makeUserForApi(['email' => 'two@example.com']);

    $response = getJson(route('api.users.index'))
        ->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonStructure([
            'data' => [
                '*' => ['id', 'name', 'email', 'status_id', 'role_id', 'person_id'],
            ],
        ]);

    $emails = collect($response->json('data'))->pluck('email');
    expect($emails)->toContain('one@example.com', 'two@example.com');
});

it('creates a user', function () {
    $payload = [
        'person_names' => 'Laura',
        'person_surnames' => 'Morales',
        'email' => 'laura@example.com',
        'password' => 'secret123',
        'status_id' => $this->status->id,
        'role_id' => $this->role->id,
    ];

    postJson(route('api.users.store'), $payload)
        ->assertCreated()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data.email', 'laura@example.com')
        ->assertJsonPath('data.name', 'Laura Morales');

    expect(User::whereEmail('laura@example.com')->exists())->toBeTrue();
});

it('updates a user', function () {
    $user = makeUserForApi(['email' => 'old@example.com']);

    $payload = [
        'person_names' => 'Updated',
        'person_surnames' => 'User',
        'email' => 'updated@example.com',
    ];

    putJson(route('api.users.update', $user), $payload)
        ->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data.email', 'updated@example.com')
        ->assertJsonPath('data.name', 'Updated User');
});

it('deletes a user', function () {
    $user = makeUserForApi();

    deleteJson(route('api.users.destroy', $user))
        ->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data', null);

    expect(User::whereKey($user->id)->exists())->toBeFalse();
});
