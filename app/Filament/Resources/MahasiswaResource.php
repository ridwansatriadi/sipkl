<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MahasiswaResource\Pages;
use App\Filament\Resources\MahasiswaResource\RelationManagers;
use App\Models\Mahasiswa;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\Label;

class MahasiswaResource extends Resource
{
    protected static ?string $model = Mahasiswa::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function getNavigationLabel(): string
    {
        $user = Filament::auth()->user();
          /** @var \App\Models\User $user */
    
        if ($user && $user->hasRole('kaprodi')) {
            return 'Kelola Mahasiswa';
        }
    
        return 'Mahasiswa'; // Label default jika bukan kaprodi
    }    protected static ?string $recordTitleAttribute = 'Mahasiswa';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                ->relationship('user', titleAttribute: 'name') // ambil dari relasi user, tampilkan kolom nama
                ->label('Nama Mahasiswa')
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
                ->preload(),
                ]);
    }

   
        public static function getQuery()
    {
        $query = Mahasiswa::query();

        // Cek jika user adalah kaprodi
        if (Auth::user()->role === 'kaprodi') {
            $kaprodi = Auth::user()->kaprodi;

            if ($kaprodi && $kaprodi->prodi_id) {
                $query->where('mahasiswas.prodi_id', $kaprodi->prodi_id);
            }
        }

        return $query;
    }

    public static function table(Table $table): Table
    {
        return $table
        ->query(
            static::getQuery()
                ->join('prodis', 'mahasiswas.prodi_id', '=', 'prodis.id')
                ->select('mahasiswas.*', 'prodis.nama as prodi')
          )
            ->columns([
                Tables\Columns\TextColumn::make('user.name') // <== Ini ambil nama dari relasi user
                ->label('Nama Mahasiswa')
                ->searchable(),
                Tables\Columns\TextColumn::make('nim')
                ->label('Nim')
                ->searchable(),
                Tables\Columns\TextColumn::make('angkatan')
                ->label('Angkatan')
                ->searchable(),
                Tables\Columns\TextColumn::make('prodi.nama')
                ->label('Prodi')
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
