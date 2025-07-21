<div class="mt-4">
   <x-mary-header title="Articles" size="text-xl" separator>
        <x-slot:middle class="!justify-end">
             <x-slot:actions>
                <x-mary-button label="Create Article" icon="o-plus" class="btn-primary" link="/dashboard/articles/create" />
            </x-slot:actions>
        </x-slot:middle>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$this->articles" striped show-empty-text>
        @scope('actions', $article)
            <div class="flex items-center">
                <x-mary-button icon="o-pencil-square" link="/dashboard/articles/{{ $article->id }}/edit" spinner class="btn-sm" />
                <x-mary-button icon="o-trash" wire:click="delete({{ $article->id }})" spinner class="btn-sm text-red-500 ml-2" />
            </div>
        @endscope
    </x-mary-table>
</div>
