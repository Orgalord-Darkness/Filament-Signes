<?php 

namespace App\Filament\Resources\CategorieResource\Pages;

use Filament\Resources\Pages\ManageRecords;
use App\Filament\Resources\CategorieResource;

class ManageCategories extends ManageRecords 
{
    protected static string $resource = CategorieResource::class; 
}