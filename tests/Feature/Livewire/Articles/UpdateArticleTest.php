<?php

use App\Livewire\Articles\UpdateArticle;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(UpdateArticle::class)
        ->assertStatus(200);
});
