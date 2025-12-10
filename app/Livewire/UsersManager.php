<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Person;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Livewire\Traits\WithSorting;

class UsersManager extends Component
{
    use WithPagination;
    use WithSorting;

    // Search & Filter
    public $search = '';
    public $perPage = 10;

    // Model Properties
    public $person_names;
    public $person_surnames;
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
        'sortField' => ['except' => 'id'],
        'sortDirection' => ['except' => 'desc'],
        'perPage' => ['except' => 10],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';

        $users = User::with('person')
            ->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                      ->orWhere('email', 'like', $searchTerm)
                      ->orWhereHas('person', function ($query) use ($searchTerm) {
                          $query->where('names', 'like', $searchTerm)
                                ->orWhere('surnames', 'like', $searchTerm);
                      });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

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
        $user = User::with('person')->findOrFail($id);
        $this->user_id = $user->id;
        $this->email = $user->email;
        $this->person_names = $user->person->names ?? '';
        $this->person_surnames = $user->person->surnames ?? '';
        $this->isEditing = true;
        $this->managingUser = true;

        $this->dispatch('open-modal', name: 'user-modal');
    }

    public function save()
    {
        $this->validate([
            'person_names' => ['required', 'string', 'max:255'],
            'person_surnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user_id)],
            'password' => $this->isEditing ? ['nullable', 'string', 'min:8'] : ['required', 'string', 'min:8'],
        ]);

        $personData = [
            'names' => $this->person_names,
            'surnames' => $this->person_surnames,
        ];

        if ($this->isEditing) {
            $user = User::findOrFail($this->user_id);
            $person = $user->person;

            if ($person) {
                $person->update($personData);
            } else {
                $person = Person::create($personData);
            }

            $data = [
                'name' => $person->full_name,
                'email' => $this->email,
                'person_id' => $person->id,
            ];

            if (!empty($this->password)) {
                $data['password'] = Hash::make($this->password);
            }

            $user->update($data);
            session()->flash('message', 'User updated successfully.');
        } else {
            $person = Person::create($personData);

            User::create([
                'name' => $person->full_name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'status_id' => 1, // Default params
                'role_id' => 1,
                'person_id' => $person->id,
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
        $this->person_names = '';
        $this->person_surnames = '';
        $this->email = '';
        $this->password = '';
        $this->user_id = null;
    }
}
