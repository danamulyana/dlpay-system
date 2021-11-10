<?php

namespace App\Http\Livewire\Component;

use Livewire\Component;

class Select2 extends Component
{

    public $results = [];
    public $datas;

    public function hydrate()
    {
        $this->emit('select2');
    }

    public function render()
    {
        return view('livewire.component.select2');
    }
}
