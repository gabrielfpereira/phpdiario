<?php

use App\Livewire\Categories\Index;
use Livewire\Livewire;

it('renders successfully', function () {
    \App\Models\Category::factory()->count(3)->create();

    Livewire::test(Index::class)
        ->assertStatus(200);
});
