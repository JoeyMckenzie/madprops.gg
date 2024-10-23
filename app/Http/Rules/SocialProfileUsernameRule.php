<?php

declare(strict_types=1);

namespace App\Http\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

final class SocialProfileUsernameRule implements ValidationRule
{
    #[\Override]
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Twitter username rules:
        // - Only alphanumeric characters and underscores
        // - Between 4 and 15 characters long
        // - No @ symbol or URLs allowed

        if ($value === null) {
            $fail('Username cannot be null.');

            return;
        }

        if (! is_string($value)) {
            $fail('Username must be a string.');

            return;
        }

        // Fail if the username starts with @
        if (str_starts_with($value, '@')) {
            $fail('Please enter the username without the @ symbol.');

            return;
        }

        $username = trim($value);

        // Fail if input contains any URL patterns
        $urlPatterns = [
            'twitter.com',
            'linkedin.com',
            'github.com',
            'pinkary.com',
            'x.com',
            'http://',
            'https://',
            'www.',
            '/',
            '://',
        ];

        // stripos() returns the position where it finds the pattern
        // or false if not found
        // If ANY of these patterns are found, return false (validation fails)
        foreach ($urlPatterns as $pattern) {
            if (stripos($username, $pattern) !== false) {
                $fail('Please enter a valid username, not the URL.');
            }
        }

        $usernameIsValid = (bool) preg_match('/^\w{4,15}$/', $username);

        if (! $usernameIsValid) {
            $fail('Please enter a valid username.');
        }
    }
}
