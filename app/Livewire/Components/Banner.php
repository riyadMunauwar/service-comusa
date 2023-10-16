<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Banner as BannerModel;

class Banner extends Component
{
    protected $banner;

    public function mount()
    {
        $this->banner = BannerModel::first();
    }


    public function render()
    {
        return view('components.banner');
    }
}
