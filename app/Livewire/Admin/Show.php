<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class Show extends Component
{
    public $user;
    
    public function render()
    {
        return view('livewire.admin.show');
    }
}
