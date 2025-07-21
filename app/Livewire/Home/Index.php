<?php

namespace App\Livewire\Home;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    public $articles;

    #[Layout("components.layouts.guest")]
    public function render()
    {
        return view('livewire.home.index');
    }

    public function mount()
    {
        $this->articles = \App\Models\Article::latest()->take(5)->get();
    }
}
