<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Models\Employee;

class TestimonialsBlock extends ContentBlockTemplate
{
    protected static function makeFilamentSchema(): array|\Closure
    {
        return [
            //
        ];
    }

    public function render()
    {
        return view('cms::livewire.blocks.testimonials-block');
    }
}
