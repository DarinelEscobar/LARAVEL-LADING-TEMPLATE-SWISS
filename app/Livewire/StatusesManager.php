<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Status;
use App\Models\StatusType;
use App\Livewire\Traits\WithSorting;
use Illuminate\Validation\Rule;

class StatusesManager extends Component
{
    use WithPagination;
    use WithSorting;

    // Search & Filter
    public $search = '';
    public $perPage = 10;

    // Model Properties
    public $name;
    public $order;
    public $status_type_id;
    public $status_id;

    // Modal States
    public $confirmingDeletion = false;
    public $managingStatus = false;
    public $isEditing = false;
    public $statusToDeleteId;

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
        $statuses = Status::with('type')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhereHas('type', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.statuses-manager', [
            'statuses' => $statuses,
            'types' => StatusType::orderBy('name')->get(),
        ])->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetInputs();
        $this->isEditing = false;
        $this->managingStatus = true;
        // Set default order if needed, or leave empty
        $this->order = 0;
        $this->dispatch('open-modal', name: 'status-modal');
    }

    public function edit($id)
    {
        $this->resetInputs();
        $status = Status::findOrFail($id);
        $this->status_id = $status->id;
        $this->name = $status->name;
        $this->order = $status->order;
        $this->status_type_id = $status->status_type_id;

        $this->isEditing = true;
        $this->managingStatus = true;

        $this->dispatch('open-modal', name: 'status-modal');
    }

    public function save()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
            'status_type_id' => ['required', 'exists:status_types,id'],
        ]);

        if ($this->isEditing) {
            $status = Status::findOrFail($this->status_id);
            $status->update([
                'name' => $this->name,
                'order' => $this->order,
                'status_type_id' => $this->status_type_id,
            ]);
            session()->flash('message', 'Status updated successfully.');
        } else {
            Status::create([
                'name' => $this->name,
                'order' => $this->order,
                'status_type_id' => $this->status_type_id,
            ]);
            session()->flash('message', 'Status created successfully.');
        }

        $this->managingStatus = false;
        $this->dispatch('close-modal');
    }

    public function confirmDeletion($id)
    {
        $this->statusToDeleteId = $id;
        $this->confirmingDeletion = true;
        $this->dispatch('open-modal', name: 'delete-confirmation');
    }

    public function delete()
    {
        $status = Status::findOrFail($this->statusToDeleteId);
        $status->delete();

        $this->confirmingDeletion = false;
        $this->statusToDeleteId = null;
        $this->dispatch('close-modal');
        session()->flash('message', 'Status deleted successfully.');
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->order = '';
        $this->status_type_id = '';
        $this->status_id = null;
    }
}
