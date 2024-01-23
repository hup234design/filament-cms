<?php

namespace Hup234design\FilamentCms\Models;

use Illuminate\Database\Eloquent\Model;
//use RalphJSmit\Laravel\SEO\Support\HasSEO;

class IndexPage extends Model
{
    //use HasSEO;

    protected $guarded = [];

    protected $casts = [
        'content'    => 'array',
        'blocks'     => 'array',
    ];
}
