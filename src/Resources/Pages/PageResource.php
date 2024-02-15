<?php

namespace Hup234design\FilamentCms\Resources\Pages;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Forms\Components\CmsGridLayout;
use Hup234design\FilamentCms\Forms\Fields\ContentBlocksBuilder;
use Hup234design\FilamentCms\Forms\Fields\Header;
use Hup234design\FilamentCms\Forms\Fields\MediablePicker;
use Hup234design\FilamentCms\Forms\Fields\TitleSlug;
use Hup234design\FilamentCms\Resources\Pages\PageResource\Pages;
use Hup234design\FilamentCms\Resources\Pages\PageResource\RelationManagers;
use Hup234design\FilamentCms\Models\Page;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use RalphJSmit\Filament\SEO\SEO;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->orderBy('is_home','desc')
            ->orderBy('is_visible','asc');
    }


    public static function form(Form $form): Form
    {
        return $form->schema([
            CmsGridLayout::make([
                Forms\Components\Tabs::make('Tabs')
                    ->tabs([
                        Forms\Components\Tabs\Tab::make('General')
                            ->schema([
                                TitleSlug::make(static::$model)
                                    ->columns(2)
                                    ->columnSpanFull(),
                                TiptapEditor::make('content')
                                    ->profile('cms')
                                    ->maxWidth('full')
                                    ->output(TiptapOutput::Json)
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Header')
                            ->schema([
                                Header::make()->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Content Blocks')
                            ->schema([
                                ContentBlocksBuilder::make()
                            ]),
                        Forms\Components\Tabs\Tab::make('SEO')
                            ->schema([
                                SEO::make(['title','description']),
                                MediablePicker::make("seo_image", "seo")->columnSpanFull(),
                            ]),
                    ])
            ],[
                Forms\Components\Section::make([
                    Forms\Components\Toggle::make('is_home')
                        ->label('Home Page')
                        ->default(false)
                        ->live()
                        ->columnSpanFull(),
                    Forms\Components\Toggle::make('is_visible')
                        ->label('Visible')
                        ->default(true)
                        ->columnSpanFull()
                        ->hidden(fn(Forms\Get $get) => $get('is_home')),
                ])
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_column')
            ->columns([
                Tables\Columns\IconColumn::make('is_home')
                    ->label(false)
                    ->trueIcon('heroicon-s-home')
                    ->falseIcon(false)
                    ->extraCellAttributes(['style' => 'width: 40px']),

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible?')
                    ->disabled(fn(Page $record) => $record->is_home),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Updated')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: false),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
