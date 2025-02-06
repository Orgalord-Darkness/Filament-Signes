<?php

namespace App\Filament\Resources\CatFaqResource\Pages;

use App\Filament\Resources\CatFaqResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatFaqs extends ListRecords
{
    protected static string $resource = CatFaqResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
