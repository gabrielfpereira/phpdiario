<?php

use App\Livewire\Home\Index;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});
