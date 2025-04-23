<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LaporanResource\Pages;
use App\Filament\Resources\LaporanResource\RelationManagers;
use App\Models\Laporan;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Laporan';
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
                Forms\Components\FileUpload::make('file_laporan')
                ->label(label: 'File Laporan')
                ->directory('laporan-pkl')
                ->disk('public')
                ->acceptedFileTypes(['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->required(),
                Forms\Components\Select::make('status_verifikasi')
                ->label(label: 'Status')
                ->options([
                    'belum diverifikasi' => 'Belum Diverifikasi',
                    'diterima' => 'Diterima',
                    'ditolak' => 'Ditolak',
                ])
                ->required(),
                Forms\Components\RichEditor::make('keterangan')
                ->label(label: 'Keterangan')
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bimbingan.mahasiswa.user.name')
                    ->label('Nama Mahasiswa'),
                    Tables\Columns\TextColumn::make('file_laporan')
                    ->label('File Laporan')
                    ->formatStateUsing(fn ($state) => 'Lihat File')
                    ->url(fn ($record) => asset('storage/' . $record->file_laporan))
                    ->openUrlInNewTab(),                         
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan'),
                Tables\Columns\TextColumn::make('status_verifikasi')
                    ->label('Status'),
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
            'index' => Pages\ListLaporans::route('/'),
            'create' => Pages\CreateLaporan::route('/create'),
            'edit' => Pages\EditLaporan::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'Laporan'; 
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
