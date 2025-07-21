<?php

use App\Livewire\Home\Show;
use Livewire\Livewire;

it('renders successfully', function () {
    $user    = \App\Models\User::factory()->create();
    $article = \App\Models\Article::factory()->for($user)->create([
        'slug'   => 'has-slug',
        'author' => $user->name,
    ]);

    Livewire::test(Show::class, ['slug' => 'has-slug'])
        ->assertStatus(200);
});
