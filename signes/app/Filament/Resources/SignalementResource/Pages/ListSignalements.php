<?php

namespace App\Filament\Resources\SignalementResource\Pages;

use App\Filament\Resources\SignalementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSignalements extends ListRecords
{
    protected static string $resource = SignalementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
