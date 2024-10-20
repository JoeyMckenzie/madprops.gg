<?php

declare(strict_types=1);

use App\Console\Commands\PerformDatabaseBackupCommand;

Schedule::command(PerformDatabaseBackupCommand::class)->everySixHours();
