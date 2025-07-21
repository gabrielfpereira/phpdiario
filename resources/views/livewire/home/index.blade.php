<div class="sm:w-1/2 w-full mx-auto mt-6">
    @foreach ($articles as $article)
        <x-mary-card title="{{ $article->title }}" class="bg-base-200 mb-4">
            {{ $article->tags->pluck('name')->implode(', ') }}

            <x-slot:figure>
                <img src="https://s2-g1.glbimg.com/oq3vNKhnYKjQWAf_77we5aXQsCE=/0x0:1200x675/810x456/smart/filters:max_age(3600)/https://i.s3.glbimg.com/v1/AUTH_59edd422c0c84a879bd37670ae4f538a/internal_photos/bs/2024/f/h/mKA3g9SxqNcNjPLcIiSQ/whatsapp-image-2024-10-28-at-10.17.32.jpeg" />
            </x-slot:figure>
            
            <x-slot:actions separator>
                <div class="flex justify-between w-full">
                    <div class="flex items-center space-x-2">
                        <x-mary-button icon="o-share" class="btn-circle btn-sm" />
                        <x-mary-icon name="o-heart" class="cursor-pointer" />
                    </div>
                    <x-mary-button label="Continue lendo..." link="{{ route('articles.show', $article->slug) }}" class="btn-primary" />
                </div>
            </x-slot:actions>
        </x-mary-card>
    @endforeach
</div>
