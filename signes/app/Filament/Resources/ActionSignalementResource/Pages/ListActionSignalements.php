<?php

namespace App\Filament\Resources\ActionSignalementResource\Pages;

use App\Filament\Resources\ActionSignalementResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActionSignalements extends ListRecords
{
    protected static string $resource = ActionSignalementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
