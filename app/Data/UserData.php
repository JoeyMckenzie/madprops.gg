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

    public string $avatar;

    public string $jobTitle;

    public string $companyName;

    public string $bio;
}
