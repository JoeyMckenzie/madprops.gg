<?php

declare(strict_types=1);

use App\Http\Rules\SocialProfileUsernameRule;

beforeEach(fn (): \App\Http\Rules\SocialProfileUsernameRule => $this->rule = new SocialProfileUsernameRule);

// Helper function to check if validation fails
function assertValidationFails(SocialProfileUsernameRule $rule, mixed $value): void
{
    $failed = false;

    $rule->validate('username', $value, function () use (&$failed): void {
        $failed = true;
    });

    expect($failed)->toBeTrue();
}

// Helper function to check if validation passes
function assertValidationPasses(SocialProfileUsernameRule $rule, string $value): void
{
    $failed = false;

    $rule->validate('username', $value, function () use (&$failed): void {
        $failed = true;
    });

    expect($failed)->toBeFalse();
}

test('it passes for valid usernames', function (): void {
    $validUsernames = Illuminate\Support\Collection::make([
        'johndoe',
        'john_doe',
        'john123',
        'UPPERCASE',
        'j_123_doe',
        '1234567890123', // 13 characters
        'minimumfour', // More than 4 chars
    ]);

    $validUsernames->each(fn (string $username) => assertValidationPasses($this->rule, $username));
});

test('it fails for valid usernames with @ symbol', function (): void {
    $validUsernames = [
        '@johndoe',
        '@john_doe',
        '@john123',
    ];

    foreach ($validUsernames as $username) {
        assertValidationFails($this->rule, $username);
    }
});

test('it fails for usernames shorter than 4 characters', function (): void {
    $shortUsernames = [
        'abc',
        'ab',
        'a',
        '',
    ];

    foreach ($shortUsernames as $username) {
        assertValidationFails($this->rule, $username);
    }
});

test('it fails for usernames longer than 15 characters', function (): void {
    assertValidationFails($this->rule, 'thisusernameistoolong123');
});

test('it fails for usernames with special characters', function (): void {
    $invalidUsernames = [
        'john.doe',
        'john-doe',
        'john$doe',
        'john#doe',
        'john&doe',
        'john!doe',
    ];

    foreach ($invalidUsernames as $username) {
        assertValidationFails($this->rule, $username);
    }
});

test('it fails for URLs and URL-like patterns', function (): void {
    $urlPatterns = [
        'twitter.com/johndoe',
        'x.com/johndoe',
        'http://twitter.com/johndoe',
        'https://twitter.com/johndoe',
        'www.twitter.com/johndoe',
        'johndoe/profile',
        'http://johndoe',
        'https://johndoe',
        'www.johndoe',
        'johndoe://something',
    ];

    foreach ($urlPatterns as $pattern) {
        assertValidationFails($this->rule, $pattern);
    }
});

test('it fails for mixed case URL patterns', function (): void {
    $mixedCaseUrls = [
        'TWITTER.com/johndoe',
        'Twitter.COM/johndoe',
        'HTTPS://twitter.com/johndoe',
        'WWW.twitter.com/johndoe',
    ];

    foreach ($mixedCaseUrls as $url) {
        assertValidationFails($this->rule, $url);
    }
});

test('it fails for null or non-string values', function (): void {
    $invalidValues = [
        null,
        123,
        [],
        new stdClass,
    ];

    foreach ($invalidValues as $value) {
        assertValidationFails($this->rule, $value);
    }
});
