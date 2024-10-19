<?php

declare(strict_types=1);

use App\Models\User;

test('registration screen can be rendered', function (): void {
    $response = $this->get('/register');

    $response->assertStatus(200);
});

test('new users can register', function (): void {
    $response = $this->post('/register', [
        'first_name' => 'Test',
        'last_name' => 'User',
        'username' => 'test.user',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $user = User::firstWhere(['email' => 'test@example.com'], ['username']);

    $this->assertAuthenticated();
    $response->assertRedirect(route('profile.show', $user->username, absolute: false));
});
