<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
//use Hup234design\FilamentCms\Filament\Forms\Fields\ContentBlockHeader;
use Filament\Forms\Get;
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
                                Radio::make('include_header')
                                    ->label('Include Header')
                                    ->inline()
                                    ->live()
                                    ->boolean()
                                    ->default(false),
                                Group::make()
                                    ->visible(fn(Get $get) => $get('include_header'))
                                    ->schema([
                                        Radio::make('header_alignment')
                                            ->label('Alignment')
                                            ->options([
                                                'center' => 'Center',
                                                'left' => 'Left',
                                            ])
                                            ->inline()
                                            ->live()
                                            ->default('center'),
                                        TextInput::make('header_title')
                                            ->label('Header Title')
                                            ->inlineLabel()
                                            ->required(),
                                        Textarea::make('header_text')
                                            ->label('Header Text')
                                            ->inlineLabel()
                                    ])
                            ])
                            ->visible(fn() => static::$includeHeader),
                        Tabs\Tab::make('Options')
                            ->schema([
                                Select::make('block_style')
                                    ->inlineLabel()
                                    ->placeholder('Default')
                                    ->options(config('cms.content_block_styles', [
                                        'light' => 'Light',
                                        'dark' => 'Dark',
                                    ]))
                                    ->live(),
                                Radio::make('block_boxed')
                                    ->inline()
                                    ->boolean()
                                    ->default(false)
                                    ->visible(fn(Get $get) => $get('block_style'))
                            ])
                    ])
            ]);
    }

    public function mount($blockData)
    {
        $this->blockData = $blockData;
    }
}
