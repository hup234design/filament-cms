<?php

namespace Hup234design\FilamentCms\Filament\Resources\Posts;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Carbon\Carbon;
use FilamentTiptapEditor\Enums\TiptapOutput;
use FilamentTiptapEditor\TiptapEditor;
use Hup234design\FilamentCms\Filament\Forms\Components\MediablePreview;
use Hup234design\FilamentCms\Filament\Forms\Fields\FeaturedImage;
use Hup234design\FilamentCms\Filament\Forms\SidebarLayout;
use Hup234design\FilamentCms\Filament\Resources\Posts\PostResource\Pages;
use Hup234design\FilamentCms\Filament\Resources\Posts\PostResource\RelationManagers;
use Hup234design\FilamentCms\Models\Page;
use Hup234design\FilamentCms\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Hup234design\FilamentCms\Models\PostCategory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use RalphJSmit\Filament\Components\Forms\Timestamps;
use RalphJSmit\Filament\SEO\SEO;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\TextInput::make('title')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn(string $operation, $state, Forms\Set $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),

                    Forms\Components\TextInput::make('slug')
                        ->required()
                        ->unique(Post::class, 'slug', ignoreRecord: true)
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn($state, Forms\Set $set) => $set('slug', Str::slug($state))),
                ])
                ->columnSpanFull()
                ->columns(2),

            Forms\Components\Textarea::make('summary')
                ->required()
                ->rows(3)
                ->columnSpanFull(),

            TiptapEditor::make('content')
                ->profile('minimal')
                ->output(TiptapOutput::Json)
                ->columnSpanFull(),

            Forms\Components\Select::make('post_category_id')
                ->label('Category')
                ->options(PostCategory::all()->pluck('title','id')),

            Forms\Components\DateTimePicker::make('publish_at')
                ->label('Publish At')
                ->default(Carbon::now())
                ->columnSpanFull(),

            Forms\Components\Toggle::make('is_visible')
                ->label('Visible')
                ->default(true)
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('publish_at', 'desc')
            ->columns([

                Tables\Columns\TextColumn::make('title')
                    ->searchable(),

                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),

                Tables\Columns\TextColumn::make('post_category.title')
                    ->label('Category'),

                Tables\Columns\TextColumn::make('publish_at')
                    ->label('Publish At')
                    ->dateTime(),

                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible?')
                    ->disabled(fn(Post $record) => $record->is_home),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}