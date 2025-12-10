<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UsersManager extends Component
{
    use WithPagination;

    // Search & Filter
    public $search = '';

    // Model Properties
    public $name;
    public $email;
    public $password;
    public $user_id;

    // Modal States
    public $confirmingDeletion = false;
    public $managingUser = false;
    public $isEditing = false;
    public $userToDeleteId;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.users-manager', [
            'users' => $users,
        ])->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetInputs();
        $this->isEditing = false;
        $this->managingUser = true;
        $this->dispatch('open-modal', name: 'user-modal');
    }

    public function edit($id)
    {
        $this->resetInputs();
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->isEditing = true;
        $this->managingUser = true;

        $this->dispatch('open-modal', name: 'user-modal');
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            'password' => $this->isEditing ? ['nullable', 'string', 'min:8'] : ['required', 'string', 'min:8'],
        ]);

        if ($this->isEditing) {
            $user = User::findOrFail($this->user_id);
            $data = [
                'name' => $this->name,
                'email' => $this->email,
            ];

            if (!empty($this->password)) {
                $data['password'] = Hash::make($this->password);
            }

            $user->update($data);
            session()->flash('message', 'User updated successfully.');
        } else {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'status_id' => 1, // Default params
                'role_id' => 1,
                'person_id' => 1,
            ]);
            session()->flash('message', 'User created successfully.');
        }

        $this->managingUser = false;
        $this->dispatch('close-modal');
    }

    public function confirmDeletion($id)
    {
        $this->userToDeleteId = $id;
        $this->confirmingDeletion = true;
        $this->dispatch('open-modal', name: 'delete-confirmation');
    }

    public function delete()
    {
        $user = User::findOrFail($this->userToDeleteId);
        $user->delete();

        $this->confirmingDeletion = false;
        $this->userToDeleteId = null;
        $this->dispatch('close-modal');
        session()->flash('message', 'User deleted successfully.');
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->user_id = null;
    }
}
