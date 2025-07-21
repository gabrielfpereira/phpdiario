<?php

namespace App\Livewire\Articles;

use App\Models\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;
use Mary\Traits\Toast;

class CreateArticle extends Component
{
    use Toast;

    public ?string $title = null;

    public ?string $content = null;

    public ?string $author = null;

    public ?string $slug = null;

    public ?int $category_id = null;

    public ?int $user_id = null;

    public $tags_selected = [];

    #[\Livewire\Attributes\Layout('components.layouts.mary')]
    public function render()
    {
        return view('livewire.articles.create-article');
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
        //dd($this->title);
        $this->slug    = Str::slug($this->title ?? 'Untitled Article');
        $this->user_id = Auth::id();
        $this->author  = Auth::user()->name ?? 'Unknown Author';

        $this->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'author'      => 'required|string|max:255',
            'slug'        => 'required|string|max:255|unique:articles,slug,' . ($this->slug ? $this->slug : 'NULL') . ',slug',
            'category_id' => 'required|exists:categories,id',
            'user_id'     => 'required|exists:users,id',
        ]);

        $article = Article::create([
            'title'       => $this->title,
            'content'     => $this->content,
            'author'      => Auth::user()->name ?? 'Unknown Author',
            'slug'        => Str::slug($this->slug ?? $this->title),
            'category_id' => $this->category_id,
            'user_id'     => Auth::id(),
        ]);
        $article->tags()->sync($this->tags_selected);

        $this->success('Article created successfully.');

        return redirect()->route('dashboard.articles');
    }
}
