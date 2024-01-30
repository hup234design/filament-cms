<?php

namespace Hup234design\FilamentCms\Curator\Curations;

use Awcodes\Curator\Curations\CurationPreset;

class ThumbnailPreset extends CurationPreset
{
    public function getKey(): string
    {
        return 'thumbnail';
    }

    public function getLabel(): string
    {
        return 'Thumbnail';
    }

    public function getWidth(): int
    {
        return 400;
    }

    public function getHeight(): int
    {
        return 300;
    }

    public function getFormat(): string
    {
        return 'jpg';
    }

    public function getQuality(): int
    {
        return 60;
    }
}
