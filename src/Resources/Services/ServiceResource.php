<?php

namespace Hup234design\FilamentCms\Resources\Services;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Carbon\Carbon;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Filament\Forms\Components\MediablePreview;
use Hup234design\FilamentCms\Filament\Forms\Fields\FeaturedImage;
use Hup234design\FilamentCms\Filament\Forms\SidebarLayout;
use Hup234design\FilamentCms\Forms\Components\CmsGridLayout;
use Hup234design\FilamentCms\Forms\Fields\ContentBlocksBuilder;
use Hup234design\FilamentCms\Forms\Fields\Header;
use Hup234design\FilamentCms\Forms\Fields\MediablePicker;
use Hup234design\FilamentCms\Forms\Fields\TitleSlug;
use Hup234design\FilamentCms\Models\PostCategory;
use Hup234design\FilamentCms\Resources\Services\ServiceResource\Pages;
use Hup234design\FilamentCms\Resources\Services\ServiceResource\RelationManagers;
use Hup234design\FilamentCms\Models\Page;
use Hup234design\FilamentCms\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Hup234design\FilamentCms\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use RalphJSmit\Filament\SEO\SEO;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function shouldRegisterNavigation(): bool
    {
        return cms('services_enabled', false);
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
                                Forms\Components\Textarea::make('summary')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull(),
                                TiptapEditor::make('content')
                                    ->profile('cms')
                                    ->maxWidth('full')
                                    ->output(TiptapOutput::Json)
                                    ->columnSpanFull(),
                            ]),
                        Forms\Components\Tabs\Tab::make('Featured Image')
                            ->schema([
                                MediablePicker::make("featured_image", "featured")->columnSpanFull(),
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
                    Forms\Components\Select::make('service_category_id')
                        ->label('Category')
                        ->options(ServiceCategory::all()->pluck('title','id')),
                    Forms\Components\Toggle::make('is_visible')
                        ->label('Visible')
                        ->default(true)
                        ->columnSpanFull(),
                ])
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order_column')
            ->defaultSort('order_column', 'asc')
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('service_category.title')
                    ->label('Category'),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible?')
                    ->disabled(fn(Service $record) => $record->is_home),

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
            'index' => Pages\ListServices::route('/'),
            'create' => Pages\CreateService::route('/create'),
            'edit' => Pages\EditService::route('/{record}/edit'),
        ];
    }
}
