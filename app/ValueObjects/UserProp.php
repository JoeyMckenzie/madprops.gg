<?php

declare(strict_types=1);

namespace App\ValueObjects;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
final class UserProp
{
    public string $username;

    public string $fullName;

    public string $jobTitle;

    public string $company;

    public string $avatarUrl;

    public ?string $message = null;
}
