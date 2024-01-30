<?php

namespace Hup234design\FilamentCms\Commands;

use Awcodes\Curator\Models\Media;
use Hup234design\FilamentCms\Actions\GenerateMediaCurations;
use Illuminate\Console\Command;

class RegenerateMediaCurations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:regenerate-media-curations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rengenerate media curations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Processing all Media images...');

        $this->newLine();

        $progressBar = $this->output->createProgressBar(Media::count());

        Media::all()->each(function ($media) use ($progressBar) {
            GenerateMediaCurations::execute($media->id);
            $progressBar->advance();
        });

        $progressBar->finish();

        $this->newLine(2);

        $this->info('Processing complete!');
    }
}
