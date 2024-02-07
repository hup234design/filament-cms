<?php

use Illuminate\Support\Facades\View;

// helpers.php

if (!function_exists('cms')) {
    function cms($key = null, $default = null)
    {
        if ($key === null) {
            return app(\Hup234design\FilamentCms\FilamentCmsSettings::class);
        }
        return app(\Hup234design\FilamentCms\FilamentCmsSettings::class)->get($key, $default);
    }
}
