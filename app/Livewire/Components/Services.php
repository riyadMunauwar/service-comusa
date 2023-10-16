<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Service;

class Services extends Component
{

    use WithPagination;


    public function render()
    {
        return view('components.services', [
            'services' => $this->getServices(),
        ]);
    }

    public function getServices()
    {
        return Service::paginate(12);
    }
}
