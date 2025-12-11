<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Person;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserApiController extends Controller
{
    public function index(): JsonResponse
    {
        $users = User::query()
            ->with('person')
            ->latest('id')
            ->get();

        return response()->json($users);
    }

    public function store(UserStoreRequest $request): JsonResponse
    {
        $data = $request->validated();

        $person = Person::create([
            'names' => $data['person_names'],
            'surnames' => $data['person_surnames'],
        ]);

        $user = User::create([
            'name' => $person->full_name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status_id' => $request->integer('status_id', $this->defaultStatusId()),
            'role_id' => $request->integer('role_id', $this->defaultRoleId()),
            'person_id' => $person->id,
        ]);

        return response()->json($user->load('person'), 201);
    }

    public function show(User $user): JsonResponse
    {
        return response()->json($user->load('person'));
    }

    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $data = $request->validated();

        $person = $user->person ?? new Person();
        $person->fill([
            'names' => $data['person_names'],
            'surnames' => $data['person_surnames'],
        ]);
        $person->save();

        $user->name = $person->full_name;
        $user->email = $data['email'];
        $user->person_id = $person->id;

        if ($request->filled('password')) {
            $user->password = Hash::make($data['password']);
        }

        if ($request->has('status_id')) {
            $user->status_id = $request->integer('status_id', $this->defaultStatusId());
        }

        if ($request->has('role_id')) {
            $user->role_id = $request->integer('role_id', $this->defaultRoleId());
        }

        $user->save();

        return response()->json($user->load('person'));
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(null, 204);
    }

    private function defaultStatusId(): int
    {
        return Status::query()->orderBy('id')->value('id') ?? 1;
    }

    private function defaultRoleId(): int
    {
        return Role::query()->orderBy('id')->value('id') ?? 1;
    }
}
