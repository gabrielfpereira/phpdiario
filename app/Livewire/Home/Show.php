<?php

namespace App\Livewire\Home;

use App\Models\Article;
use League\CommonMark\{GithubFlavoredMarkdownConverter};
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    public $article;

    public $content;

    #[Layout("components.layouts.guest")]
    public function render()
    {
        return view('livewire.home.show');
    }

    public function mount(string $slug)
    {
        $this->article = Article::where('slug', $slug)->firstOrFail();
        $converter     = new GithubFlavoredMarkdownConverter();
        $this->content = $converter->convert($this->article->content)->getContent();
    }

}
