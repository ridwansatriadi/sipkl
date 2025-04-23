<?php

namespace App\Filament\Resources\DplResource\Pages;

use App\Filament\Resources\DplResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDpls extends ListRecords
{
    protected static string $resource = DplResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTitle(): string
    {
        return "Dpl";
    }
}
