<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Person;
use App\Models\User;
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
            'status_id' => 1,
            'role_id' => 1,
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
}
