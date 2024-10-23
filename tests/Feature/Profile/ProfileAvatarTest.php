<?php

declare(strict_types=1);

use App\Models\User;
use Illuminate\Http\UploadedFile;

test('profile avatars can be updated', function (): void {
    // Arrange
    Storage::fake('public');
    $image = UploadedFile::fake()->image('photo.jpg');
    $user = User::factory()->create([
        'avatar' => null,
    ]);

    expect($user->avatar)->toBeEmpty();

    // Act
    $response = $this
        ->actingAs($user)
        ->post('/profile/avatar', [
            'avatar' => $image,
        ]);

    // Assert
    $fileName = 'avatars/'.$image->hashName();
    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');
    Storage::disk('public')->assertExists($fileName);
    $user->refresh();
    expect($user->avatar)->toBe($fileName);
});
