<?php

namespace App\Filament\Resources\DplResource\Pages;

use App\Filament\Resources\DplResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDpl extends EditRecord
{
    protected static string $resource = DplResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
