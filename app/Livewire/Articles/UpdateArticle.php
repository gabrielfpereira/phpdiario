<?php

namespace App\Livewire\Articles;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Mary\Traits\Toast;

class UpdateArticle extends Component
{
    use Toast;

    public ?int $id = null;

    public ?string $title = null;

    public ?string $content = null;

    public ?string $author = null;

    public ?string $slug = null;

    public ?int $category_id = null;

    public ?int $user_id = null;

    public $tags_selected = [];

    #[Layout('components.layouts.mary')]
    public function render()
    {
        return view('livewire.articles.update-article');
    }

    public function mount(\App\Models\Article $article)
    {
        $this->id            = $article->id;
        $this->title         = $article->title;
        $this->content       = $article->content;
        $this->author        = $article->author;
        $this->slug          = $article->slug;
        $this->category_id   = $article->category_id;
        $this->user_id       = $article->user_id;
        $this->tags_selected = $article->tags()->pluck('tags.id')->toArray();
    }

    #[\Livewire\Attributes\Computed()]
    public function categories()
    {
        return \App\Models\Category::query()
            ->select(['id', 'name', 'slug'])
            ->orderBy('id', 'desc')
            ->get();
    }

    #[\Livewire\Attributes\Computed()]
    public function tags()
    {
        return \App\Models\Tag::query()
            ->select(['id', 'name', 'slug'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function save()
    {
        $this->slug   = \Illuminate\Support\Str::slug($this->title ?? 'Untitled Article');
        $this->author = \Illuminate\Support\Facades\Auth::user()->name ?? 'Unknown Author';

        $this->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'author'      => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:articles,slug,' . ($this->slug ? $this->slug : 'NULL') . ',slug',
            'category_id' => 'required|exists:categories,id',
        ]);

        $article = \App\Models\Article::updateOrCreate(
            ['id' => $this->id],
            [
                'title'       => $this->title,
                'content'     => $this->content,
                'author'      => $this->author,
                'slug'        => $this->slug,
                'category_id' => $this->category_id,
            ]
        );

        $article->tags()->sync($this->tags_selected);

        $this->success('Article updated successfully.');

        return redirect()->route('dashboard.articles');
    }
}
