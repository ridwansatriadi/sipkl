<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NilaiResource\Pages;
use App\Filament\Resources\NilaiResource\RelationManagers;
use App\Models\Nilai;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NilaiResource extends Resource
{
    protected static ?string $model = Nilai::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Nilai';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('bimbingan_id')
                ->label(label: 'Nama Mahasiswa')
                ->options(
                    \App\Models\Bimbingan::with('mahasiswa.user')
                        ->get()
                        ->mapWithKeys(function ($bimbingan) {
                            return [$bimbingan->id => "{$bimbingan->mahasiswa->nim} - {$bimbingan->mahasiswa->user->name}"];
                        })
                )
                ->searchable()
                ->preload()
                ->required(),
                Forms\Components\TextInput::make('pengamatan')
                ->label(label: 'Pengamatan Dilapangan')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('kesimpulan')
                ->label(label: 'Kesimpulan dan Saran')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('sistematika')
                ->label(label: 'Sistematika Penulisan')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('bahasa')
                ->label(label: 'Struktur Bahasa')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('jumlah')
                ->label(label: 'Jumlah')
                ->required()
                ->numeric(),
                Forms\Components\TextInput::make('nilai')
                ->label(label: 'Nilai Rata-Rata')
                ->required()
                ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bimbingan.mahasiswa.user.name')
                    ->label('Nama Mahasiswa'),
                Tables\Columns\TextColumn::make('pengamatan')
                    ->label('Pengamatan Dilapangan')
                    ->numeric(),
                Tables\Columns\TextColumn::make('kesimpulan')
                    ->label('Kesimpulan Dan Saran')
                    ->numeric(),
                Tables\Columns\TextColumn::make('sistematika')
                    ->label('Sistematika Penulisan')
                    ->numeric(),
                Tables\Columns\TextColumn::make('bahasa')
                    ->label('Struktur Bahasa')
                    ->numeric(),
                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->numeric(),
                Tables\Columns\TextColumn::make('nilai')
                    ->label('Nilai Rata-Rata')
                    ->numeric(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListNilais::route('/'),
            'create' => Pages\CreateNilai::route('/create'),
            'edit' => Pages\EditNilai::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Nilai'; // Supaya tidak jadi "Mahasiswas"
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();
    
        if ($user->role === 'mahasiswa') {
            return parent::getEloquentQuery()->whereHas('bimbingan.mahasiswa', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }
    
        if ($user->role === 'dpl') {
            return parent::getEloquentQuery()->whereHas('bimbingan', function ($query) use ($user) {
                $query->where('dpl_id', $user->dpl->id);
            });
        }
    
        return parent::getEloquentQuery();
    }
}
