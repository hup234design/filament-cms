<?php

namespace Hup234design\FilamentCms\Resources\Enquiries\EnquiryResource\Pages;

use Hup234design\FilamentCms\Resources\Enquiries\EnquiryResource;
use Carbon\Carbon;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Builder;

class ManageEnquiries extends ManageRecords
{
    protected static string $resource = EnquiryResource::class;

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('spam', false)),
            'today' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->whereDate('created_at', '=', Carbon::now())),
            'spam' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('spam', true)),
        ];
    }
}
