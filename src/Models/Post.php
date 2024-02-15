<?php

namespace Hup234design\FilamentCms\Models;

use Hup234design\FilamentCms\Concerns\HasHeader;
use Hup234design\FilamentCms\Concerns\HasMediables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RalphJSmit\Laravel\SEO\Support\HasSEO;

//use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Post extends Model
{
    use HasSEO;
    use HasMediables;
    use HasHeader;

    protected $guarded = [];

    protected $casts = [
        'content'    => 'array',
        'blocks'     => 'array',
        'publish_at' => 'datetime',
        'is_visible' => 'boolean',
    ];

    public function post_category(): BelongsTo
    {
        return $this->belongsTo(PostCategory::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    protected static function boot()
    {
        parent::boot();

        // Order by home page and then by sort order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder
                ->orderBy('publish_at', 'desc');
        });
    }
}
