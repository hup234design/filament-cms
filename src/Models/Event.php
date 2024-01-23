<?php

namespace Hup234design\FilamentCms\Models;

use Carbon\Carbon;
//use Hup234design\FilamentCms\Concerns\HasHeader;
//use Hup234design\FilamentCms\Concerns\HasMediables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
//use RalphJSmit\Laravel\SEO\Support\HasSEO;

class Event extends Model
{
    //use HasSEO;
    //use HasMediables;
    //use HasHeader;

    protected $guarded = [];

    protected $casts = [
        'content'    => 'array',
        'blocks'     => 'array',
        'date'       => 'date',
        'is_visible' => 'boolean',
    ];

    public function event_category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class);
    }

    public function scopeVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function scopeUpcoming($query)
    {
        return $query->whereDate('date', '>=', Carbon::now());
    }

}
