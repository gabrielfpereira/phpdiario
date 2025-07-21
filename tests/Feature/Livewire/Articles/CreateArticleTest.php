<?php

use App\Livewire\Articles\CreateArticle;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateArticle::class)
        ->assertStatus(200);
});
