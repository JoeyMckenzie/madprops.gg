<?php

declare(strict_types=1);

use App\Models\User;

test('profile socials can be updated', function (): void {
    $user = User::factory()->create();

    expect($user->x_username)->toBeEmpty()
        ->and($user->linkedin_username)->toBeEmpty()
        ->and($user->github_username)->toBeEmpty()
        ->and($user->pinkary_username)->toBeEmpty();

    $response = $this
        ->actingAs($user)
        ->patch('/profile/socials', [
            'display_socials' => true,
            'x_username' => 'l33t_h4ck3r',
            'linkedin_username' => 'JohnSmith',
            'github_username' => 'johnsmith',
            'pinkary_username' => 'johniscool',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    expect($user->x_username)->toBe('l33t_h4ck3r')
        ->and($user->linkedin_username)->toBe('JohnSmith')
        ->and($user->github_username)->toBe('johnsmith')
        ->and($user->pinkary_username)->toBe('johniscool');
});

test('profile socials have errors if @ symbol is included', function (): void {
    $user = User::factory()->create();

    expect($user->x_username)->toBeEmpty()
        ->and($user->linkedin_username)->toBeEmpty()
        ->and($user->github_username)->toBeEmpty()
        ->and($user->pinkary_username)->toBeEmpty();

    $response = $this
        ->actingAs($user)
        ->patch('/profile/socials', [
            'display_socials' => true,
            'x_username' => '@l33t_h4ck3r',
            'linkedin_username' => '@JohnSmith',
            'github_username' => '@johnsmith',
            'pinkary_username' => '@johniscool',
        ]);

    $response
        ->assertSessionHasErrors([
            'x_username' => 'Please enter the username without the @ symbol.',
            'linkedin_username' => 'Please enter the username without the @ symbol.',
            'github_username' => 'Please enter the username without the @ symbol.',
            'pinkary_username' => 'Please enter the username without the @ symbol.',
        ]);
});

test('profile socials has errors when username is invalid', function (): void {
    $user = User::factory()->create();

    expect($user->x_username)->toBeEmpty()
        ->and($user->linkedin_username)->toBeEmpty()
        ->and($user->github_username)->toBeEmpty()
        ->and($user->pinkary_username)->toBeEmpty();

    $response = $this
        ->actingAs($user)
        ->patch('/profile/socials', [
            'display_socials' => true,
            'x_username' => 'l33t_h4ck3r()()---',
            'linkedin_username' => 'JohnSmith---%@#!%',
            'github_username' => 'johnsmith---!@#^',
            'pinkary_username' => 'johniscool!@#($_--',
        ]);

    $response
        ->assertSessionHasErrors([
            'x_username' => 'Please enter a valid username.',
            'linkedin_username' => 'Please enter a valid username.',
            'github_username' => 'Please enter a valid username.',
            'pinkary_username' => 'Please enter a valid username.',
        ]);
});
