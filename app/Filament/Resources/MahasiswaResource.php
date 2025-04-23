<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Mahasiswa';
    protected static ?string $recordTitleAttribute = 'Mahasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->relationship('user', titleAttribute: 'name') // ambil dari relasi user, tampilkan kolom nama
                ->label('Nama Mahasiswa')
                ->searchable()
                ->required()
                ->preload(),
                Forms\Components\TextInput::make('nim')
                ->label('NIM')
                ->required(),
                Forms\Components\TextInput::make('angkatan')
                ->label('Angkatan')
                ->required(),
                Forms\Components\Select::make('prodi_id')
                ->label('Prodi')
                ->relationship('prodi', titleAttribute: 'nama') // ambil dari relasi user, tampilkan kolom nama
                ->required()
                ->searchable()
                ->preload(),
                ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name') // <== Ini ambil nama dari relasi user
                ->label('Nama Mahasiswa'),
                    // ->numeric(),
                //     ->label('No'),
                    
                // Tables\Columns\TextColumn::make('user')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('nim'),
                    // ->numeric(),
                  
                Tables\Columns\TextColumn::make('angkatan'),
                    // ->numeric(),
                    
                Tables\Columns\TextColumn::make('prodi.nama')
                    ->numeric()
                    ->label('Prodi'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListMahasiswas::route('/'),
            'create' => Pages\CreateMahasiswa::route('/create'),
            'edit' => Pages\EditMahasiswa::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
{
    return 'Mahasiswa'; // Supaya tidak jadi "Mahasiswas"
}
}
