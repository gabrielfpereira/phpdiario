<?php

namespace App\Livewire\Articles;

use Livewire\Attributes\{Computed, Layout};
use Livewire\Component;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast;

    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'title', 'label' => 'Title'],
        ['key' => 'slug', 'label' => 'Slug'],
    ];

    #[Layout('components.layouts.mary')]
    public function render()
    {
        return view('livewire.articles.index');
    }

    #[Computed()]
    public function articles()
    {
        return \App\Models\Article::query()
            ->select(['id', 'title', 'slug'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function delete($id)
    {
        $article = \App\Models\Article::findOrFail($id);
        $article->delete();

        $this->error('Article deleted successfully.');
    }
}
