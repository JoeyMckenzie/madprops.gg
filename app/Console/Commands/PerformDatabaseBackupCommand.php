<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

/**
 * Shamelessly stolen from Pinkary. Give it a start!
 */
final class PerformDatabaseBackupCommand extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'perform:database-backup';

    /**
     * The console command description.
     */
    protected $description = 'Perform a database backup.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $filename = 'backup-'.now()->timestamp.'.sql';

        File::copy(database_path('database.sqlite'), database_path('backups/'.$filename));

        $glob = File::glob(database_path('backups/*.sql'));
        $copiesToMaintain = Config::integer('database.sqlite.backup_copies');

        collect($glob)->sort()->reverse()->slice($copiesToMaintain)->each(
            fn (string $backup): bool => File::delete($backup),
        );
    }
}
