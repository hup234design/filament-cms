<?php

namespace Hup234design\FilamentCms\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use RuntimeException;
use Symfony\Component\Process\Process;

class SetupCommand extends Command
{
    public $signature = 'cms:setup';

    public $description = 'Setup Filament CMS';

    public function handle(): int
    {
        $this->warn('This will setup Filament CMS');

        if ($this->confirm('Do you wish to continue?', false) )
        {
            // filament/filament
            $this->call('vendor:publish', [
                "--tag" => "filament-config",
            ]);

            // ralphjsmit/laravel-filament-seo
            $this->call('vendor:publish', [
                "--tag" => "seo-migrations",
            ]);
            $this->call('vendor:publish', [
                "--tag" => "seo-config",
            ]);

            // spatie/eloquent-sortable
            $this->call('vendor:publish', [
                "--tag" => "eloquent-sortable-config",
            ]);

            // spatie/laravel-google-fonts
            $this->call('vendor:publish', [
                "--provider" => "Spatie\GoogleFonts\GoogleFontsServiceProvider",
                "--tag" => "google-fonts-config",
            ]);

            // spatie/laravel-honeypot
            $this->call('vendor:publish', [
                "--provider" => "Spatie\Honeypot\HoneypotServiceProvider",
                "--tag" => "honeypot-config",
            ]);

            // spatie/laravel-cookie-consent
            $this->call('vendor:publish', [
                "--provider" => "Spatie\CookieConsent\CookieConsentServiceProvider",
                "--tag" => "cookie-consent-config",
            ]);
            $this->call('vendor:publish', [
                "--provider" => "Spatie\CookieConsent\CookieConsentServiceProvider",
                "--tag" => "cookie-consent-views",
            ]);

            // awcodes/filament-tiptap-editor
            $this->call('vendor:publish', [
                "--tag" => "filament-tiptap-editor-config",
            ]);

            // filament assets
            $this->call('filament:assets');

            // spatie/laravel-ray
            $this->callSilently('ray:publish-config');

            // awcodes/filament-curator ( includes migrations )
            $this->call('curator:install');
            $this->call('vendor:publish', [
                "--tag" => "curator-config",
            ]);

            if ($this->confirm("Do you want to install NPM packages?",false)){
                $this->runCommands([
                    'npm install -D tailwindcss postcss autoprefixer @tailwindcss/typography @tailwindcss/forms cropperjs'
                ]);
            }

            if ($this->confirm("Do you want to copy the css and js files?",false)){
                (new Filesystem())->copyDirectory(
                    __DIR__ . '/../../stubs/resources/css',
                    resource_path('css')
                );
                (new Filesystem())->copy(
                    __DIR__ . '/../../stubs/tailwind.config.js',
                    base_path('tailwind.config.js')
                );
                (new Filesystem())->copy(
                    __DIR__ . '/../../stubs/postcss.config.js',
                    base_path('postcss.config.js')
                );
                (new Filesystem())->copy(
                    __DIR__ . '/../../stubs/vite.config.js',
                    base_path('vite.config.js')
                );
            }

            $this->runCommands([
                'npm run build'
            ]);

            $this->newLine();
            $this->info('Filament CMS successfully setup.');

            return self::SUCCESS;
        }

        return self::FAILURE;

//        $this->info('Backing up table to `media_tmp`...');

        // remove exiting tmp table if exists
//        if (Schema::hasTable('media_tmp')) {
//            Schema::dropIfExists('media_tmp');
//        }

//        $tableName = app(config('curator.model'))->getTable();

        // get db driver
//        $driver = Arr::get(DB::connection()->getConfig(), 'driver');

        // clone db as a backup
//        match ($driver) {
//            'sqlite' => function () use ($tableName): void {
//                DB::statement('CREATE TABLE media_tmp AS SELECT * FROM ' . $tableName);
//            },
//            'pgsql' => function () use ($tableName): void {
//                DB::statement('CREATE TABLE media_tmp AS (SELECT * FROM ' . $tableName . ')');
//            },
//            default => function () use ($tableName): void {
//                DB::statement('CREATE TABLE media_tmp LIKE media');
//                DB::statement('INSERT media_tmp SELECT * FROM ' . $tableName);
//            }
//        };

        // publish migration
//        $this->info('Publishing migration...');

//        $migrationsPath = realpath(__DIR__ . '/../../database/migrations');

//        foreach (glob("{$migrationsPath}/upgrade_*.php.stub") as $filename) {
//            File::copy(
//                $filename,
//                $this->generateMigrationName(
//                    basename($filename),
//                    Carbon::now()->addSecond()
//                )
//            );
//        }

//        $this->info('Running migration...');

//        $this->call('migrate');

        // process existing entries to fill new db fields
//        $this->info('Updating media entries...');

//        $mediaCount = DB::table($tableName)->count();

//        if ($mediaCount > 0) {
//            $progress = $this->output->createProgressBar($mediaCount);
//
//            DB::table($tableName)->chunkById(500, function ($media) use ($progress, $tableName) {
//                foreach ($media as $item) {
//                    DB::table($tableName)
//                        ->where('id', $item->id)
//                        ->update([
//                            'visibility' => Storage::disk($item->disk)->getVisibility($item->path),
//                        ]);
//                }
//
//                $progress->advance();
//            });
//
//            $progress->finish();
//        } else {
//            $this->comment('No media entries to process.');
//        }

//        foreach (['public_id', 'filename'] as $column) {
//            if (Schema::hasColumn($tableName, $column)) {
//                Schema::table($tableName, function (Blueprint $table) use ($column) {
//                    $table->dropColumn($column);
//                });
//            }
//        }

        $this->newLine();
        $this->info('Filament CMS successfully setup.');

        return self::SUCCESS;
    }

    /**
     * Run the given commands.
     *
     * @param  array  $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> '.$e->getMessage().PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    '.$line);
        });
    }
}
