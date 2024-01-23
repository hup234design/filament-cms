<?php

namespace Hup234design\FilamentCms\Models;

//use Hup234design\FilamentCms\Concerns\HasHeader;
//use Hup234design\FilamentCms\Concerns\HasMediables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
//use RalphJSmit\Laravel\SEO\Support\HasSEO;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Page extends Model implements Sortable
{
    use SortableTrait;
    //use HasSEO;
    //use HasMediables;
    //use HasHeader;

    protected $guarded = [];

    protected $casts = [
        'content'    => 'array',
        'blocks'     => 'array',
        'is_home'    => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    protected static function boot()
    {
        parent::boot();

        // when saved update home page flag on all other pages
        static::saved(function ($model) {
            if ($model->is_home) {
                $model->updateQuietly(['is_visible' => true]);
                Page::whereNot('id', $model->id)->where('is_home', true)->update(['is_home' => false]);
            }
        });

        // Order by home page and then by sort order
        static::addGlobalScope('order', function (Builder $builder) {
            $builder
                ->orderBy('is_home', 'desc')
                ->orderBy('order_column', 'asc');
        });
    }
}
