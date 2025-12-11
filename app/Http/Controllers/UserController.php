<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Person;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::all();

        return view('user.index', [
            'users' => $users,
        ]);
    }

    public function create(Request $request): View
    {
        return view('user.create');
    }

    public function store(UserStoreRequest $request): RedirectResponse
    {
        $person = Person::create([
            'names' => $request->person_names,
            'surnames' => $request->person_surnames,
        ]);

        $user = User::create([
            'name' => $person->full_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status_id' => $this->defaultStatusId(),
            'role_id' => $this->defaultRoleId(),
            'person_id' => $person->id,
        ]);

        $request->session()->flash('user.id', $user->id);

        return redirect()->route('users.index');
    }

    public function show(Request $request, User $user): View
    {
        return view('user.show', [
            'user' => $user,
        ]);
    }

    public function edit(Request $request, User $user): View
    {
        return view('user.edit', [
            'user' => $user,
        ]);
    }

    public function update(UserUpdateRequest $request, User $user): RedirectResponse
    {
        $person = $user->person ?? Person::create([
            'names' => $request->person_names,
            'surnames' => $request->person_surnames,
        ]);

        $person->update([
            'names' => $request->person_names,
            'surnames' => $request->person_surnames,
        ]);

        $user->name = $person->full_name;
        $user->email = $request->email;
        $user->person_id = $person->id;
        $user->status_id = $user->status_id ?? $this->defaultStatusId();
        $user->role_id = $user->role_id ?? $this->defaultRoleId();

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        $request->session()->flash('user.id', $user->id);

        return redirect()->route('users.index');
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('users.index');
    }

    protected function defaultStatusId(): int
    {
        $status = Status::query()->orderBy('id')->first();

        if ($status) {
            return $status->id;
        }

        return Status::create([
            'name' => 'Activo',
            'order' => 1,
            'status_type_id' => Status::query()->max('status_type_id') ?? 1,
        ])->id;
    }

    protected function defaultRoleId(): int
    {
        $role = Role::query()->orderBy('id')->first();

        if ($role) {
            return $role->id;
        }

        return Role::create(['name' => 'Admin'])->id;
    }
}
