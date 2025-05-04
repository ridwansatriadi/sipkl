<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratResource\Pages;
use App\Filament\Resources\SuratResource\RelationManagers;
use App\Models\Surat;
use Barryvdh\DomPDF\Facade\Pdf; 
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
// use Illuminate\Container\Attributes\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratResource extends Resource
{
    protected static ?string $model = Surat::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Surat';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('pengajuan_id')
                ->label('Nama Mahasiswa')
                ->options(
                    \App\Models\Pengajuan::with('mahasiswa.user')
                        ->get()
                        ->mapWithKeys(function ($bimbingan) {
                            return [$bimbingan->id => "{$bimbingan->mahasiswa->nim} - {$bimbingan->mahasiswa->user->name}"];
                        })
                )
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\Select::make('jenis_surat')
                ->label('Jenis Surat')
                ->required()
                ->options([
                    'Surat Permohonan Izin' => 'Surat Permohonan Izin',
                    'Surat Jalan' => 'Surat Jalan',
                    'Surat Penarikan' => 'Surat Penarikan',
                ])
                ->native(false)
                ->searchable()
                ->required(),
            Forms\Components\DatePicker::make('tanggal_mulai')
                ->label('Tanggal Mulai')
                ->required(),

            Forms\Components\DatePicker::make('tanggal_selesai')
                ->label('Tanggal Selesai')
                ->required(),
         
                Forms\Components\DatePicker::make('tanggal_terbit')
                ->default(now())
                ->required(),
        ]);
    }
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pengajuan.mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
    
                Tables\Columns\TextColumn::make('jenis_surat')
                    ->label('Jenis Surat')
                    ->searchable(),
    
                Tables\Columns\TextColumn::make('tanggal_terbit')
                    ->label('Tanggal')
                    ->date()
                    ->searchable(),
    
                Tables\Columns\TextColumn::make('file_surat')
                    ->label('File Surat')
                    ->formatStateUsing(fn ($state) => 'download surat')
                    ->url(fn ($record) => asset('storage/' . $record->file_surat))
                    ->openUrlInNewTab(),    
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSurats::route('/'),
            'create' => Pages\CreateSurat::route('/create'),
            'edit' => Pages\EditSurat::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Surat';
    }
}