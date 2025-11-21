<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $users;

    public function render()
    {
        return view('livewire.admin.index');
    }

    public function mount(){
        $this->users = User::all();
    }
}
