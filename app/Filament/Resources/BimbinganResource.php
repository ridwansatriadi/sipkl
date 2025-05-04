<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BimbinganResource\Pages;
use App\Filament\Resources\BimbinganResource\RelationManagers;
use App\Models\Bimbingan;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BimbinganResource extends Resource
{
    protected static ?string $model = Bimbingan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        $user = Filament::auth()->user();
          /** @var \App\Models\User $user */
    
        if ($user && $user->hasRole('kaprodi')) {
            return 'Kelola Bimbingan';
        }
    
        return 'Bimbingan'; // Label default jika bukan kaprodi
    }    protected static ?string $pluralLabel = 'Bimbingan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('mahasiswa_id')
                ->label('Nama Mahasiswa')
                ->options(function () {
                    $user = Filament::auth()->user();
    
                    // Cek apakah user kaprodi dan punya relasi kaprodi
                    if ($user->role === 'kaprodi' && $user->kaprodi) {
                        $prodiId = $user->kaprodi->prodi_id;
    
                        return \App\Models\Mahasiswa::with('user')
                            ->where('prodi_id', $prodiId)
                            ->get()
                            ->mapWithKeys(function ($mahasiswa) {
                                return [$mahasiswa->id => "{$mahasiswa->nim} - {$mahasiswa->user->name}"];
                            });
                    }
    
                    return [];
                })
                ->searchable()
                ->preload()
                ->required(),
    
                // Forms\Components\Select::make('mahasiswa_id')
                //     ->label('Nama Mahasiswa')
                //     ->options(
                //         \App\Models\Mahasiswa::with('user')
                //             ->whereHas('user', fn ($query) => $query->where('role', 'mahasiswa'))
                //             ->get()
                //             ->mapWithKeys(function ($mahasiswa) {
                //                 return [$mahasiswa->id => "{$mahasiswa->nim} - {$mahasiswa->user->name}"];
                //             })
                //     )
                //     ->searchable()
                //     ->preload()
                //     ->required(),

                Forms\Components\Select::make('dpl_id')
                    ->label('Dosen Pembimbing')
                    ->options(
                    \App\Models\Dpl::with('user')
                        ->whereHas('user', fn ($query) => $query->where('role', 'dpl'))
                        ->get()
                        ->pluck('user.name', 'id') // pastikan 'nama' adalah kolom dari table users
                )
                    ->searchable()
                    ->preload()
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required(),

                Forms\Components\DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('dpl.user.name')
                    ->label('Nama DPL')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->date()
                    ->searchable(),
            ])
            ->filters([
                // Tambahkan filter jika diperlukan
            ])
            ->actions([
                Tables\Actions\EditAction::make()->visible(fn () => Filament::auth()->user()->role === 'kaprodi'),
                Tables\Actions\DeleteAction::make()->visible(fn () => Filament::auth()->user()->role === 'kaprodi'),
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
            'index' => Pages\ListBimbingans::route('/'),
            'create' => Pages\CreateBimbingan::route('/create'),
            'edit' => Pages\EditBimbingan::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Bimbingan'; // Supaya tidak jadi "Mahasiswas"
    }

    public static function getEloquentQuery(): Builder
{
    $user = Filament::auth()->user();
    if ($user->role === 'kaprodi' && $user->kaprodi) {
        return parent::getEloquentQuery()
            ->whereHas('mahasiswa', function ($query) use ($user) {
                $query->where('prodi_id', $user->kaprodi->prodi_id);
            });
    }

    if ($user->role === 'dpl' && $user->dpl) {
        return parent::getEloquentQuery()
            ->where('dpl_id', $user->dpl->id);
    }

    if ($user->role === 'mahasiswa' && $user->mahasiswa) {
        return parent::getEloquentQuery()
            ->where('mahasiswa_id', $user->mahasiswa->id);
    }

    return parent::getEloquentQuery();
}

public static function canCreate(): bool
{
    return Filament::auth()->user()->role === 'kaprodi';
}

}
