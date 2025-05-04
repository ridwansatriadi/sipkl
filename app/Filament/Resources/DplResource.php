<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DplResource\Pages;
use App\Filament\Resources\DplResource\RelationManagers;
use App\Models\Dpl;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DplResource extends Resource
{
    protected static ?string $model = Dpl::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        $user = Filament::auth()->user();
          /** @var \App\Models\User $user */
    
        if ($user && $user->hasRole('kaprodi')) {
            return 'Kelola DPL';
        }
    
        return 'Dpl'; // Label default jika bukan kaprodi
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('Nama Dosen Pembimbing')
                    ->relationship('user', titleAttribute: 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('nidn')
                    ->label('NIDN')
                    ->required(),
                Forms\Components\TextInput::make('bidang_keahlian')
                    ->label('Bidang Keahlian')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Nama Dosen Pembimbing')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nidn')
                    ->label('NIDN')
                    ->searchable(),
                Tables\Columns\TextColumn::make('bidang_keahlian')
                    ->label('Bidang Keahlian')
                    ->searchable(),
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
            'index' => Pages\ListDpls::route('/'),
            'create' => Pages\CreateDpl::route('/create'),
            'edit' => Pages\EditDpl::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Dpl'; // Supaya tidak jadi "Mahasiswas"
    }
}
