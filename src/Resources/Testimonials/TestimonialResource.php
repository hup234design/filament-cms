<?php

namespace Hup234design\FilamentCms\Resources\Testimonials;

use Carbon\Carbon;
use Hup234design\FilamentCms\Resources\Testimonials\TestimonialResource\Pages;
use Hup234design\FilamentCms\Resources\Testimonials\TestimonialResource\RelationManagers;
use Hup234design\FilamentCms\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?int $navigationSort = 5;

    public static function shouldRegisterNavigation(): bool
    {
        return cms('testimonials_enabled', false);
    }

    public static function getNavigationBadge(): ?string
    {
        return number_format(static::getModel()::count());
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required(),
                Forms\Components\TextInput::make('location'),
                Forms\Components\TextInput::make('company'),
                Forms\Components\TextInput::make('job_title'),
                Forms\Components\Textarea::make('content')
                    ->required()
                    ->rows(6)
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('received_on')
                    ->required()
                    ->default(Carbon::now()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('received_on', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('received_on')
                    ->label('Received')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('location')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company')
                    ->searchable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job Title')
                    ->searchable(),
                Tables\Columns\ToggleColumn::make('is_visible')
                    ->label('Visible?'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->since()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->slideOver(),
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
            'index' => Pages\ListTestimonials::route('/'),
        ];
    }
}
