<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SuratBalasanResource\Pages;
use App\Filament\Resources\SuratBalasanResource\RelationManagers;
use App\Models\SuratBalasan;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SuratBalasanResource extends Resource
{
    protected static ?string $model = SuratBalasan::class;
    public static function getNavigationLabel(): string
    {
        $user = Filament::auth()->user();
          /** @var \App\Models\User $user */
    
        if ($user && $user->hasRole('kaprodi')) {
            return 'Verifikasi Surat Balasan';
        }
    
        return 'Surat Balasan'; // Label default jika bukan kaprodi
    }
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('pengajuan_id')
                ->label('Nama Mahasiswa')
                ->options(
                    \App\Models\Pengajuan::with('mahasiswa.user')
                        ->get()
                        ->mapWithKeys(function ($pengajuan) {
                            return [$pengajuan->id => "{$pengajuan->mahasiswa->nim} - {$pengajuan->mahasiswa->user->name}"];
                        })
                )
                ->preload()
                ->required(),
                Forms\Components\FileUpload::make('file')
                ->label(label: 'File Surat')
                ->directory('surat-balasan')
                ->disk('public')
                ->acceptedFileTypes(['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->required(),
                Forms\Components\DatePicker::make('tanggal_upload')
                ->label('Tanggal')
                ->required(),
                Forms\Components\Select::make('status')
                ->label(label: 'Status')
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
                Tables\Columns\TextColumn::make('pengajuan.mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file')
                    ->label('File Surat')
                    ->formatStateUsing(fn ($state) => 'Lihat File')
                    ->url(fn ($record) => asset('storage/' . $record->file))
                    ->openUrlInNewTab(),        
                Tables\Columns\TextColumn::make('tanggal_upload')
                    ->label('Tanggal')
                    ->date()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
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
            'index' => Pages\ListSuratBalasans::route('/'),
            'create' => Pages\CreateSuratBalasan::route('/create'),
            'edit' => Pages\EditSuratBalasan::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        $user = Filament::auth()->user();
    
        if ($user->role === 'kaprodi' && $user->kaprodi) {
            return parent::getEloquentQuery()
                ->whereHas('pengajuan.mahasiswa', function ($query) use ($user) {
                    $query->where('prodi_id', $user->kaprodi->prodi_id);
                });
        }
    
        if ($user->role === 'mahasiswa' && $user->mahasiswa) {
            return parent::getEloquentQuery()
                ->whereHas('pengajuan.mahasiswa', function ($query) use ($user) {
                    $query->where('id', $user->mahasiswa->id);
                });
        }
    
        return parent::getEloquentQuery();
    }
    
    
}
