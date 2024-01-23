<?php

namespace Hup234design\FilamentCms\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class PostCategory extends Model implements Sortable
{
    use SortableTrait;

    protected $guarded = [];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function visible_posts(): HasMany
    {
        return $this->hasMany(Post::class)->visible();
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
