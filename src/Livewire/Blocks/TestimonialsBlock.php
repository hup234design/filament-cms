<?php

namespace Hup234design\FilamentCms\Livewire\Blocks;

use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Get;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Models\Employee;
use Hup234design\FilamentCms\Models\Testimonial;

class TestimonialsBlock extends ContentBlockTemplate
{
    protected static function makeFilamentSchema(): array|\Closure
    {
        return [
            Group::make()
                ->columns(2)
                ->schema([
                    Group::make()
                        ->schema([
                            Radio::make('selection')
                                ->label('Single or Multiple Testimonials')
                                ->options([
                                    'single'    => 'Single',
                                    'multiple'  => 'Multiple',
                                ])
                                ->required()
                                ->inline()
                                ->default('single')
                                ->live(),
                            Radio::make('layout')
                                ->label('Layout')
                                ->options([
                                    'carousel' => 'Carousel',
                                    'slider'   => 'Slider',
                                    'grid'     => 'Grid',
                                ])
                                ->required()
                                ->inline()
                                ->default('carousel')
                                ->visible(fn(Get $get) => $get('selection') == 'multiple'),
                            Radio::make('random')
                                ->label('Use Random Testimonials')
                                ->boolean()
                                ->required()
                                ->inline()
                                ->default(false)
                                ->live(),
                            TextInput::make('random_count')
                                ->label('Number of random testimonials')
                                ->numeric()
                                ->step(1)
                                ->inlineLabel()
                                ->required()
                                ->default(1)
                                ->minValue(1)
                                ->extraAttributes(['class' => 'max-w-40'])
                                ->visible(fn(Get $get) => $get('random') && $get('selection') == 'multiple'),
                        ]),
                    Group::make()
                        ->hidden(fn(Get $get) => $get('random'))
                        ->schema([
                            Select::make('testimonial_id')
                                ->label('Testimonial')
                                ->options(Testimonial::visible()->pluck('name','id'))
                                ->required()
                                ->visible(fn(Get $get) => $get('selection') == 'single'),
                            TableRepeater::make('testimonials')
                                ->headers([
                                    Header::make('name'),
                                ])
                                ->renderHeader(false)
                                ->emptyLabel('There are no testimonials selected.')
                                ->schema([
                                    Select::make('testimonial_id')
                                        ->options(Testimonial::visible()->pluck('name','id'))
                                        ->required(),
                                ])
                                ->visible(fn(Get $get) => $get('selection') == 'multiple'),
                        ]),
                ]),
        ];
    }

    public function render()
    {
        $testimonial = null;
        $testimonials = [];
        if( $this->blockData['random'] ?? false ) {
            if( ($this->blockData['selection'] ?? 'single') == 'single' ) {
                $testimonial = Testimonial::inRandomOrder()
                    ->first();
            } else {
                $testimonials = Testimonial::inRandomOrder()
                    ->take($this->blockData['random_count'] ?? 1)
                    ->get();
            }
        }
        return view('cms::livewire.blocks.testimonials-block', compact('testimonial','testimonials'));
    }
}
