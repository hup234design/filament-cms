<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;

class EditorBlock extends ContentBlockTemplate
{
    //protected static bool $includeHeader = false;

    protected static function makeFilamentSchema(): array|\Closure
    {
        return [
            TiptapEditor::make('content')
                ->required()
                ->profile('cms')
                ->maxWidth('full')
                ->output(TiptapOutput::Json)
                ->columnSpanFull(),
        ];
    }

    public function render()
    {
        return view('cms::livewire.blocks.editor-block');
    }
}
