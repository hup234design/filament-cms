<?php

namespace Hup234design\FilamentCms\Curator\Curations;

use Awcodes\Curator\Curations\CurationPreset;

class HeaderPreset extends CurationPreset
{
    public function getKey(): string
    {
        return 'header';
    }

    public function getLabel(): string
    {
        return 'Header';
    }

    public function getWidth(): int
    {
        return 1440;
    }

    public function getHeight(): int
    {
        return 480;
    }

    public function getFormat(): string
    {
        return 'jpg';
    }

    public function getQuality(): int
    {
        return 80;
    }
}
