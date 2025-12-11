<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\StatusType;
use App\Livewire\Traits\WithSorting;
use Illuminate\Validation\Rule;

class StatusTypesManager extends Component
{
    use WithPagination;
    use WithSorting;

    // Search & Filter
    public $search = '';
    public $perPage = 10;

    // Model Properties
    public $name;
    public $status_type_id;

    // Modal States
    public $confirmingDeletion = false;
    public $managingStatusType = false;
    public $isEditing = false;
    public $statusTypeToDeleteId;

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
        $statusTypes = StatusType::where('name', 'like', '%' . $this->search . '%')
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.status-types-manager', [
            'statusTypes' => $statusTypes,
        ])->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetInputs();
        $this->isEditing = false;
        $this->managingStatusType = true;
        $this->dispatch('open-modal', name: 'status-type-modal');
    }

    public function edit($id)
    {
        $this->resetInputs();
        $statusType = StatusType::findOrFail($id);
        $this->status_type_id = $statusType->id;
        $this->name = $statusType->name;
        $this->isEditing = true;
        $this->managingStatusType = true;

        $this->dispatch('open-modal', name: 'status-type-modal');
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('status_types')->ignore($this->status_type_id)],
        ]);

        if ($this->isEditing) {
            $statusType = StatusType::findOrFail($this->status_type_id);
            $statusType->update([
                'name' => $this->name,
            ]);
            session()->flash('message', 'Status Type updated successfully.');
        } else {
            StatusType::create([
                'name' => $this->name,
            ]);
            session()->flash('message', 'Status Type created successfully.');
        }

        $this->managingStatusType = false;
        $this->dispatch('close-modal');
    }

    public function confirmDeletion($id)
    {
        $this->statusTypeToDeleteId = $id;
        $this->confirmingDeletion = true;
        $this->dispatch('open-modal', name: 'delete-confirmation');
    }

    public function delete()
    {
        $statusType = StatusType::findOrFail($this->statusTypeToDeleteId);
        $statusType->delete();

        $this->confirmingDeletion = false;
        $this->statusTypeToDeleteId = null;
        $this->dispatch('close-modal');
        session()->flash('message', 'Status Type deleted successfully.');
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->status_type_id = null;
    }
}
