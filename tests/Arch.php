<?php

declare(strict_types=1);

namespace Tests;

arch()->preset()->laravel();

arch('Rules should be suffixed with rule', fn (): \Pest\Arch\Contracts\ArchExpectation => expect('App\Http\Rules')
    ->classes()
    ->toBeFinal()
    ->toHaveSuffix('Rule')
    ->toImplement(\Illuminate\Contracts\Validation\ValidationRule::class));

arch('All test files are strictly typed')
    ->expect('Tests\\')
    ->toUseStrictTypes();

arch('All enums are string backed')
    ->expect('App\\Enums\\')
    ->toBeStringBackedEnums();

arch('All value objects are immutable')
    ->expect('App\\ValueObjects\\')
    ->toBeReadonly()
    ->and('App\\ValueObjects')
    ->toBeFinal();

arch('All contracts are interfaces')
    ->expect('App\\Contracts\\')
    ->toBeInterfaces();
