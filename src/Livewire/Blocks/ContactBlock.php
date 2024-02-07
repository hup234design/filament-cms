<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

class ContactBlock extends ContentBlockTemplate
{
    protected static bool $includeHeader = false;

    protected static function makeFilamentSchema(): array|\Closure
    {
        return [
            //
        ];
    }

    public function render()
    {
        return view('cms::livewire.blocks.contact-block');
    }
}
