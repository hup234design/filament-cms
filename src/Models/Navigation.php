<?php

namespace Hup234design\FilamentCms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SolutionForest\FilamentTree\Concern\ModelTree;

class Navigation extends Model
{
    use ModelTree;

    protected $guarded = [];

    public function page() : BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function index_page() : BelongsTo
    {
        return $this->belongsTo(IndexPage::class);
    }
}
