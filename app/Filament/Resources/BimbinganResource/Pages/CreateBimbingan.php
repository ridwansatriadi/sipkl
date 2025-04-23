<?php

namespace App\Filament\Resources\BimbinganResource\Pages;

use App\Filament\Resources\BimbinganResource;
use Filament\Actions;
use Filament\Facades\Filament;
use Filament\Resources\Pages\CreateRecord;

class CreateBimbingan extends CreateRecord
{
    protected static string $resource = BimbinganResource::class;
    //Membatasi hanya kaprodi yang dapat creat bimbingan
   

}
