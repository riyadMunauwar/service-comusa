<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Feature;

class Features extends Component
{

    protected $features = [];

    public function mount()
    {
        $this->features = Feature::all();
    }

    public function render()
    {
        return view('components.features');
    }
}
