<?php

namespace App\Filament\Resources;

use App\Filament\Resources\KaprodiResource\Pages;
use App\Filament\Resources\KaprodiResource\RelationManagers;
use App\Models\Kaprodi;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KaprodiResource extends Resource
{
    protected static ?string $model = Kaprodi::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Kaprodi';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                    Forms\Components\Select::make('user_id')
                    ->relationship('user', titleAttribute: 'name') // ambil dari relasi user, tampilkan kolom nama
                    ->label(label: 'Nama Kaprodi')
                    ->required()
                    ->preload(),
                    Forms\Components\TextInput::make('nidn')
                    ->label(label: 'NIDN')
                    ->required(),
                    Forms\Components\Select::make('prodi_id')
                    ->label('Prodi')
                    ->relationship('prodi', titleAttribute: 'nama') // ambil dari relasi user, tampilkan kolom nama
                    ->required()
                    ->preload(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Kaprodi'),
                Tables\Columns\TextColumn::make('nidn')
                    ->label('NIDN'),
                Tables\Columns\TextColumn::make('prodi.nama')
                    ->label('Prodi'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListKaprodis::route('/'),
            'create' => Pages\CreateKaprodi::route('/create'),
            'edit' => Pages\EditKaprodi::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Kaprodi'; // Supaya tidak jadi "Mahasiswas"
    }
}
