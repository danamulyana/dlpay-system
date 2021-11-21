<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class ProfileInformation extends Component
{
    public $menus = 'personal';

    protected $listeners = ['hai' => '$refresh'];

    public function  updatedMenus($menu)
    {
        $this->emit('hai');
    }

    public function render()
    {
        return view('livewire.user.profile-information');
    }
}
