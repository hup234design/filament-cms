<?php

namespace Hup234design\FilamentCms\Pages;

use Hup234design\FilamentCms\Models\IndexPage;
use Hup234design\FilamentCms\Models\Navigation as NavigationModel;
use Filament\Forms;
use Filament\Pages\Actions\CreateAction;
use Hup234design\FilamentCms\Models\Page;
use SolutionForest\FilamentTree\Actions;
use SolutionForest\FilamentTree\Concern;
use SolutionForest\FilamentTree\Pages\TreePage as BasePage;
use SolutionForest\FilamentTree\Support\Utils;

class Navigation extends BasePage
{
    protected static string $model = NavigationModel::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

    protected static int $maxDepth = 3;

    protected function getActions(): array
    {
        return [
            $this->getCreateAction(),
            // SAMPLE CODE, CAN DELETE
            //\Filament\Pages\Actions\Action::make('sampleAction'),
        ];
    }

    protected function getTreeActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Forms\Components\TextInput::make('title'),
            Forms\Components\Select::make('parent_id')
                ->label('Menu')
                ->placeholder('New Menu')
                ->visibleOn('create')
                ->live()
                ->options(
                    NavigationModel::where('parent_id', -1)->pluck('title','id')
                ),
            Forms\Components\Group::make()
                ->schema([
                    Forms\Components\Select::make('type')
                        ->live()
                        ->options([
                            'page' => 'Page',
                            'index-page' => 'Index Page',
                            'dropdown' => 'Dropdown',
                        ]),
                    Forms\Components\Select::make('page_id')
                        ->label('Page')
                        ->options(Page::all()->pluck('title','id'))
                        ->visible(fn(Forms\Get $get) => $get('type') == 'page'),
                    Forms\Components\Select::make('index_page_id')
                        ->label('Index Page')
                        ->options(IndexPage::enabled()->pluck('title','id'))
                        ->visible(fn(Forms\Get $get) => $get('type') == 'index-page'),
                ])
                ->columns(2)
                ->visible(fn(Forms\Get $get) => $get('parent_id'))

        ];
    }

//    protected function hasDeleteAction(): bool
//    {
//        return true;
//    }
//
//    protected function hasEditAction(): bool
//    {
//        return true;
//    }
//
//    protected function hasViewAction(): bool
//    {
//        return false;
//    }

    protected function getHeaderWidgets(): array
    {
        return [];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    // CUSTOMIZE ICON OF EACH RECORD, CAN DELETE
    // public function getTreeRecordIcon(?\Illuminate\Database\Eloquent\Model $record = null): ?string
    // {
    //     return null;
    // }
}
