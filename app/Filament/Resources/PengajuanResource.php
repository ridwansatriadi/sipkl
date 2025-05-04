<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanResource\Pages;
use App\Filament\Resources\PengajuanResource\RelationManagers;
use App\Models\Pengajuan;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PengajuanResource extends Resource
{
    protected static ?string $model = Pengajuan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationLabel(): string
    {
        $user = Filament::auth()->user();
          /** @var \App\Models\User $user */
    
        if ($user && $user->hasRole('kaprodi')) {
            return 'Validasi Pengajuan';
        }
    
        return 'Pengajuan'; // Label default jika bukan kaprodi
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                 Forms\Components\Select::make('mahasiswa_id')
                    ->label('Nama Mahasiswa')
                    ->options(
                        \App\Models\Mahasiswa::with('user')
                            ->whereHas('user', fn ($query) => $query->where('role', 'mahasiswa'))
                            ->get()
                            ->mapWithKeys(function ($mahasiswa) {
                                return [$mahasiswa->id => "{$mahasiswa->nim} - {$mahasiswa->user->name}"];
                            })
                    )
                    ->searchable()
                    ->preload()
                    ->required(),
                Forms\Components\TextInput::make('nama_instansi')
                    ->label('Nama Instansi')
                    ->required(),
                    // ->maxLength(255),
                Forms\Components\TextInput::make('alamat_instansi')
                    ->label('Alamat Instansi')
                    ->required(),
                    // ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->label('Status')
                    ->options([
                        'belum diverifikasi' => 'Belum Diverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
                    ->required(),
                Forms\Components\DatePicker::make('tanggal_pengajuan')
                    ->label('Tanggal Pengajuan')
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
                Tables\Columns\TextColumn::make('nama_instansi')
                    ->label('Nama Instansi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('alamat_instansi')
                    ->label('Alamat Instansi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal_pengajuan')
                    ->date()
                    ->label('Tanggal Pengajuan')
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
            'index' => Pages\ListPengajuans::route('/'),
            'create' => Pages\CreatePengajuan::route('/create'),
            'edit' => Pages\EditPengajuan::route('/{record}/edit'),
        ];
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
    
        if ($user->role === 'mahasiswa' && $user->mahasiswa) {
            return parent::getEloquentQuery()
                ->where('mahasiswa_id', $user->mahasiswa->id);
        }
    
        return parent::getEloquentQuery();
    }
    public static function getPluralModelLabel(): string
    {
        return 'Pengajuan';
    }
    public static function canCreate(): bool
{
    return Filament::auth()->user()->role === 'mahasiswa';
}

}
