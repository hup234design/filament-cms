<?php

namespace Hup234design\FilamentCms\Concerns;

use Hup234design\FilamentCms\Models\Headerable;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasHeader
{
    public function header(): MorphOne
    {
        return $this->morphOne(Headerable::class, 'headerable');
    }
}
