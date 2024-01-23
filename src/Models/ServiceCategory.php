<?php

namespace Hup234design\FilamentCms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class ServiceCategory extends Model implements Sortable
{
    use SortableTrait;

    protected $guarded = [];

    public function services(): HasMany
    {
        return $this->hasMany(Service::class);
    }

    public function visible_services(): HasMany
    {
        return $this->hasMany(Service::class)->visible();
    }

    protected static function boot()
    {
        parent::boot();

        // Order by home page and then by sort order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder->orderBy('order_column', 'asc');
        });
    }
}
