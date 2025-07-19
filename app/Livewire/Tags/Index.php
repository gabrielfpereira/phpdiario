<?php

namespace App\Livewire\Tags;

use Illuminate\Support\Str;
use Livewire\Attributes\{Computed, Layout, Rule};
use Livewire\Component;
use Mary\Traits\Toast;

class Index extends Component
{
    use Toast;

    public array $headers = [
        ['key' => 'id', 'label' => '#'],
        ['key' => 'name', 'label' => 'Name'],
        ['key' => 'slug', 'label' => 'Slug'],
    ];

    #[Rule(['required', 'string', 'max:50'])]
    public string $name = '';

    public $tagId;

    #[Layout('components.layouts.mary')]
    public function render()
    {
        return view('livewire.tags.index');
    }

    #[Computed()]
    public function tags()
    {
        return \App\Models\Tag::query()
            ->select(['id', 'name', 'slug'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->tagId) {
            $tag = \App\Models\Tag::findOrFail($this->tagId);
            $tag->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
            $this->success('Tags updated successfully.');
        } else {
            \App\Models\Tag::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
        }

        $this->reset('name');

        $this->success('Tags created successfully.');
    }

    public function delete($id)
    {
        $tag = \App\Models\Tag::findOrFail($id);
        $tag->delete();

        $this->success('Tags deleted successfully.');
    }

    public function update($id)
    {
        $tag         = \App\Models\Tag::findOrFail($id);
        $this->name  = $tag->name;
        $this->tagId = $tag->id;
    }
}
