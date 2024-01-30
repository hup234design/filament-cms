<?php

namespace Hup234design\FilamentCms\Concerns;

use Hup234design\FilamentCms\Models\Mediable;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasMediables
{
    public function featured_image(): MorphOne
    {
        return $this->morphOne(Mediable::class, 'mediable')
            ->where('type', 'featured');
    }

    public function seo_image(): MorphOne
    {
        return $this->morphOne(Mediable::class, 'mediable')
            ->where('type', 'seo');
    }
}
