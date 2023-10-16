<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Service;

class Single extends Component
{
    public $service;

    public function mount($service_slug, $id)
    {

        $service = Service::find($id);

        if(!$service) return $this->redirect('/');

        $this->service = $service;

    }

    public function render()
    {
        return view('pages.single');
    }
}
