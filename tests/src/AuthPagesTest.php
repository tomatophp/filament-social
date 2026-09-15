<?php

use function Pest\Laravel\get;

it('renders the social login page with the configured providers', function () {
    get('/admin/login')
        ->assertSuccessful()
        ->assertSee(route('login.provider', ['provider' => 'github']), false);
});

it('hides providers that have no client id', function () {
    get('/admin/login')
        ->assertSuccessful()
        ->assertDontSee(route('login.provider', ['provider' => 'facebook']), false);
});

it('renders the social register page with the configured providers', function () {
    get('/admin/register')
        ->assertSuccessful()
        ->assertSee(route('login.provider', ['provider' => 'github']), false);
});
