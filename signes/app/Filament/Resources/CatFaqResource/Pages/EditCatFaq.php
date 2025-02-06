<?php

namespace App\Filament\Resources\CatFaqResource\Pages;

use App\Filament\Resources\CatFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatFaq extends EditRecord
{
    protected static string $resource = CatFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
