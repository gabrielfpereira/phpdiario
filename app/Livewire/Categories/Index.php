<?php

namespace App\Livewire\Categories;

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

    public $categoryId;

    #[Layout('components.layouts.mary')]
    public function render()
    {
        return view('livewire.categories.index');
    }

    #[Computed()]
    public function categories()
    {
        return \App\Models\Category::query()
            ->select(['id', 'name', 'slug'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function save()
    {
        $this->validate();

        if ($this->categoryId) {
            $category = \App\Models\Category::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
            $this->success('Category updated successfully.');
        } else {
            \App\Models\Category::create([
                'name' => $this->name,
                'slug' => Str::slug($this->name),
            ]);
        }

        $this->reset('name');

        $this->success('Category created successfully.');
    }

    public function delete($id)
    {
        $category = \App\Models\Category::findOrFail($id);
        $category->delete();

        $this->success('Category deleted successfully.');
    }

    public function update($id)
    {
        $category         = \App\Models\Category::findOrFail($id);
        $this->name       = $category->name;
        $this->categoryId = $category->id;
    }
}
