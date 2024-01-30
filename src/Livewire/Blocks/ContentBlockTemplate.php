<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Toggle;
//use Hup234design\FilamentCms\Filament\Forms\Fields\ContentBlockHeader;
use Illuminate\Support\Str;
use Livewire\Component;

abstract class ContentBlockTemplate extends Component
{
    abstract protected static function makeFilamentSchema(): array|\Closure;

    protected static bool $includeHeader = true;

    protected static function blockName(): string
    {
        return Str::snake(basename(str_replace('\\', '/', static::class)),'-');
    }

    protected static function blockLabel(): string
    {
        return Str::headline(str_replace('-block', '', static::blockName()));
    }

    public ?array $blockData;

    /**
     * Make a new Filament Block instance for this flexible block.
     */
    public static function make(): Block
    {
        return Block::make(static::blockName())
            ->label(static::blockLabel())
            ->schema([
                Tabs::make('Content Block')
                    ->schema([
                        Tabs\Tab::make('Content')
                            ->schema(static::makeFilamentSchema()),
                        Tabs\Tab::make('Header')
                            ->schema([
                                //ContentBlockHeader::make()
                            ])
                            ->visible(fn() => static::$includeHeader),
                        Tabs\Tab::make('Options')
                            ->schema([
                                Select::make('block_style')
                                    ->inlineLabel()
                                    ->placeholder('Default')
                                    ->options([
                                        'light' => 'Light',
                                        'brand' => 'Brand',
                                        'dark' => 'Dark',
                                    ]),
                                Select::make('block_width')
                                    ->inlineLabel()
                                    ->placeholder('Default')
                                    ->options(['full' => 'Full Width']),
                            ])
                    ])
            ]);
    }

    public function mount($blockData)
    {
        $this->blockData = $blockData;
    }
}
