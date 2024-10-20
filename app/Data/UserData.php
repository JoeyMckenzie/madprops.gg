<?php

declare(strict_types=1);

namespace App\Data;

use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
#[MapInputName(SnakeCaseMapper::class)]
final class UserData extends Data
{
    public string $fullName;

    public string $initials;

    public string $username;

    public string $handle;

    public ?string $avatar = null;

    public ?string $jobTitle = null;

    public ?string $companyName = null;

    public ?string $bio = null;

    public bool $displaySocials;

    public ?string $linkedinUsername = null;

    public ?string $xUsername = null;

    public ?string $githubUsername = null;

    public ?string $pinkaryUsername = null;
}
