<?php

namespace App\Filament\Pages;

use App\Models\User;
use Filament\Pages\Page;
use Filament\Forms\Components\Select;
use Filament\Pages\Dashboard as BasePage;
use Filament\Pages\Dashboard\Actions\FilterAction;
use Filament\Pages\Dashboard\Concerns\HasFiltersAction;

class Dashboard extends BasePage {

    use HasFiltersAction;

    public function getColumns(): int
    {
        return 3;
    }

    protected function getHeaderActions(): array
    {
        return [
            FilterAction::make()
                ->form([
                    Select::make('annee')->label('Année')
                        ->options([date('Y'), date('Y')-1, date('Y')-2, date('Y')-3]),
                    ])
        ];
    }
}