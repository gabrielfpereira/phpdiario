<?php

use App\Livewire\Articles\Index;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});
