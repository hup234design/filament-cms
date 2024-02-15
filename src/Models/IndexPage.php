<?php

namespace Hup234design\FilamentCms\Models;

use Hup234design\FilamentCms\Concerns\HasHeader;
use Hup234design\FilamentCms\Concerns\HasMediables;
use Illuminate\Database\Eloquent\Model;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

class IndexPage extends Model
{
    use HasSEO;
    use HasMediables;
    use HasHeader;

    protected $guarded = [];

    protected $casts = [
        'content' => 'array',
    ];

    public function scopeEnabled($query)
    {
        $query->when(! cms('services_enabled'), function($query) {
            $query->whereNot('slug','services');
        })
        ->when(! cms('testimonials_enabled'), function($query) {
            $query->whereNot('slug','testimonials');
        });
    }
}
