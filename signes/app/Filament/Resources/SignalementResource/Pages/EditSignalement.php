<?php

namespace App\Filament\Resources\SignalementResource\Pages;

use App\Filament\Resources\SignalementResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSignalement extends EditRecord
{
    protected static string $resource = SignalementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
