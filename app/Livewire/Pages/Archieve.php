<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use App\Models\Category;

class Archieve extends Component
{
    public $category;

    public function mount($category_slug, $id)
    {
        $category = Category::with('children.services')->find($id);

        if(!$category) return $this->redirect('/');

        $this->category = $category;
    }


    public function render()
    {
        return view('pages.archieve');
    }
}
