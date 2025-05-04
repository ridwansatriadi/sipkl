<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LogbookResource\Pages;
use App\Filament\Resources\LogbookResource\RelationManagers;
use App\Models\Logbook;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LogbookResource extends Resource
{
    protected static ?string $model = Logbook::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Logbook';

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('bimbingan_id')
                ->label('Nama Mahasiswa')
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

            Forms\Components\DatePicker::make('tanggal')
                ->label('Tanggal')
                ->required(),

            Forms\Components\RichEditor::make('kegiatan')
                ->label('kegiatan')
                ->required()
                ->columnSpanFull(),

            Forms\Components\FileUpload::make('dokumentasi')
                ->label('Dokumentasi')
                ->image()
                ->disk('public')
                ->required(),
            Forms\Components\Select::make('status_verifikasi')
                ->label('Status Verifikasi')
                ->options([
                    'belum diverifikasi' => 'Belum Diverifikasi',
                    'diterima' => 'Diterima',
                    'ditolak' => 'Ditolak',
                ])
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bimbingan.mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('tanggal')
                    ->date()
                    ->label('Tanggal')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('dokumentasi')
                    ->label('Dokumentasi')
                    ->circular()
                    ->disk('public'),       
                Tables\Columns\TextColumn::make('kegiatan')
                    ->label('Kegiatan')
                    ->html()
                    ->limit(400)
                    ->action(
                        Tables\Actions\Action::make('lihat_kegiatan')
                            ->label('Lihat')
                            ->icon('heroicon-o-eye')
                            ->modalHeading('Kegiatan PKL')
                            ->modalContent(fn ($record) => view('tables.columns.kegiatan-modal', ['record' => $record])) // ✅ BENAR
                        ),
                
                Tables\Columns\TextColumn::make('status_verifikasi')
                    ->label('Status Verifikasi')
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
            'index' => Pages\ListLogbooks::route('/'),
            'create' => Pages\CreateLogbook::route('/create'),
            'edit' => Pages\EditLogbook::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Logbook'; // Supaya tidak jadi "Mahasiswas"
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
