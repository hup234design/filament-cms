<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Models\Employee;
use Hup234design\FilamentCms\Models\Post;

class LatestPostsBlock extends ContentBlockTemplate
{
    protected static function makeFilamentSchema(): array|\Closure
    {
        return [
            //
        ];
    }

    public function render()
    {
        $posts = Post::visible()->take(3)->get();
        return view('cms::livewire.blocks.latest-posts-block', [
            'posts' => $posts
        ]);
    }
}
