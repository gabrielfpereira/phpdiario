<div class="mx-12">
        <x-mary-errors title="Oops!" description="Please, fix them." icon="o-face-frown" />

   <x-mary-form wire:submit="save" no-separator >
        <x-mary-header title="Create Article" />
        <x-mary-input label="Title" wire:model="title" />
        <x-mary-editor wire:model="content" label="Content" hint="Write your article content here..." :config="[
            'height' => '600px',
            'plugins' => 'codesample table lists link image preview',
            'toolbar' => 'undo redo | styles  | bold italic | alignleft aligncenter alignright | bullist numlist | codesample link image | preview',
        ]" />

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <x-mary-select label="Category" wire:model="category_id" :options="$this->categories" option-label="name" option-value="id" />
            <x-mary-choices label="Tags" wire:model="tags_selected" :options="$this->tags" option-label="name" option-value="id" multiple />
        </div>
        <x-slot:actions>
            <x-mary-button label="Create Article" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-mary-form>
</div>