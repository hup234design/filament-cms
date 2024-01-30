<?php

namespace Hup234design\FilamentCms\Models;

use Awcodes\Curator\Models\Media;
use Hup234design\FilamentCms\Actions\GenerateMediaCurations;

class CmsMedia extends Media
{
    protected $table = 'media';

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::created(function (CmsMedia $media) {
            GenerateMediaCurations::execute($media->id);
        });
    }
}
