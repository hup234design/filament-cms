<?php

namespace Hup234design\FilamentCms\Models;

use Hup234design\FilamentCms\Concerns\HasHeader;
use Hup234design\FilamentCms\Concerns\HasMediables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Service extends Model implements Sortable
{
    use SortableTrait;
    use HasSEO;
    use HasMediables;
    use HasHeader;

    protected $guarded = [];

    protected $casts = [
        'content'    => 'array',
        'blocks'     => 'array',
        'is_visible' => 'boolean',
    ];

    public function service_category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class);
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
                ->orderBy('order_column', 'asc');
        });
    }
}
