<div>
    <x-mary-header title="Tags" size="text-xl" separator>
        <x-slot:middle class="!justify-end">
            <x-mary-form wire:submit="save" no-separator>
                <div class="flex items-center justify-center gap-2">
                    <x-mary-input wire:model="name" placeholder="Create a new tag" class="w-full" />

                    <x-mary-button label="Create" class="btn-primary" type="submit" spinner="save" />
                </div>
            </x-mary-form>
        </x-slot:middle>
    </x-mary-header>

    <x-mary-table :headers="$headers" :rows="$this->tags" striped show-empty-text>
        @scope('actions', $tag)
            <div class="flex items-center">
                <x-mary-button icon="o-pencil-square" wire:click="update({{ $tag->id }})" spinner class="btn-sm" />
                <x-mary-button icon="o-trash" wire:click="delete({{ $tag->id }})" spinner class="btn-sm text-red-500 ml-2" />
            </div>
        @endscope
    </x-mary-table>


</div>
