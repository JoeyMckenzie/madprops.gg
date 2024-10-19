<?php

declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

final class ApplicationVersion
{
    private const string CACHE_KEY = 'madprops.gg-version';

    private const string DEFAULT_VERSION = '1.0.0';

    public static function getComposerVersion(): string
    {
        if (Cache::has(self::CACHE_KEY)) {
            /** @var string $version */
            $version = Cache::get(self::CACHE_KEY);

            return $version;
        }

        $composerFilePath = base_path('composer.json');

        if (! file_exists($composerFilePath)) {
            Log::warning('Unable to load composer file, not found on file system');

            return self::DEFAULT_VERSION;
        }

        /** @var string $composerJson */
        $composerJson = file_get_contents($composerFilePath);

        /** @var array{version: ?string} $composerData */
        $composerData = json_decode($composerJson, true, JSON_THROW_ON_ERROR);
        $composerVersion = $composerData['version'];

        if ($composerVersion === null || $composerVersion === '') {
            Log::warning('No version found within composer file');

            return self::DEFAULT_VERSION;
        }

        Cache::forever(self::CACHE_KEY, $composerVersion);

        return $composerVersion;
    }
}
