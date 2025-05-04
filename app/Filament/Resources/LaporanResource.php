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
use Illuminate\Container\Attributes\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LaporanResource extends Resource
{
    protected static ?string $model = Laporan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Laporan';
    public static function form(Form $form): Form
    {
              /** @var \App\Models\User $user */

        $user = Filament::auth()->user();
        $isMahasiswa = $user->hasRole('mahasiswa');
        $isDpl = $user->hasRole('dpl');
    
        return $form->schema([
            Forms\Components\Select::make('bimbingan_id')
                ->label('Nama Mahasiswa')
                ->options(function () use ($user, $isMahasiswa, $isDpl) {
                    $query = \App\Models\Bimbingan::with('mahasiswa.user');
    
                    if ($isMahasiswa && $user->mahasiswa) {
                        return $query->where('mahasiswa_id', $user->mahasiswa->id)
                            ->get()
                            ->mapWithKeys(fn ($b) => [$b->id => "{$b->mahasiswa->nim} - {$b->mahasiswa->user->name}"]);
                    }
    
                    if ($isDpl && $user->dpl) {
                        return $query->where('dpl_id', $user->dpl->id)
                            ->get()
                            ->mapWithKeys(fn ($b) => [$b->id => "{$b->mahasiswa->nim} - {$b->mahasiswa->user->name}"]);
                    }
    
                    return $query->get()
                        ->mapWithKeys(fn ($b) => [$b->id => "{$b->mahasiswa->nim} - {$b->mahasiswa->user->name}"]);
                })
                ->searchable()
                ->preload()
                ->required(),

            Forms\Components\FileUpload::make('file_laporan')
                ->label('File Laporan')
                ->directory('laporan-pkl')
                ->disk('public')
                ->acceptedFileTypes(['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->required()
                ->visible($isMahasiswa),
    
            Forms\Components\Select::make('status_verifikasi')
                ->label('Status')
                ->options([
                    'belum diverifikasi' => 'Belum Diverifikasi',
                    'diterima' => 'Diterima',
                    'ditolak' => 'Ditolak',
                ])
                ->required()
                ->visible($isDpl),
    
            Forms\Components\RichEditor::make('keterangan')
                ->label('Keterangan')
                ->required()
                ->visible($isDpl),
        ]);
    }
    
    public static function table(Table $table): Table
    {
        // 
        

        // $isDpl = $user->hasRole('dpl');
    
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('bimbingan.mahasiswa.user.name')
                    ->label('Nama Mahasiswa')
                    ->searchable(),
    
                Tables\Columns\TextColumn::make('file_laporan')
                    ->label('File Laporan')
                    ->formatStateUsing(fn ($state) => 'Lihat File')
                    ->url(fn ($record) => asset('storage/' . $record->file_laporan))
                    ->openUrlInNewTab(),  
    
                // Keterangan - inline editable untuk DPL
                Tables\Columns\TextColumn::make('keterangan')
                    ->label('Keterangan')
                    ->html(),
                    // ->limit(50),
                    // ->visible($isDpl),
                    // ->editable($isDpl), // ini mengaktifkan inline edit
    
                // Status verifikasi - dropdown editable untuk DPL
                Tables\Columns\SelectColumn::make('status_verifikasi')
                    ->label('Status')
                    ->options([
                        'belum diverifikasi' => 'Belum Diverifikasi',
                        'diterima' => 'Diterima',
                        'ditolak' => 'Ditolak',
                    ])
                    // ->visible($isDpl)
                    // ->editable($isDpl), // ini juga bisa diedit inline
            ])
            ->filters([
                // bisa ditambahkan filter by status, dpl, dsb
            ])
            ->actions([
                Tables\Actions\EditAction::make(), // tetap sediakan opsi edit
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
    public static function mutateFormDataBeforeCreate(array $data): array
    {
        $user = Filament::auth()->user();
        /** @var \App\Models\User $user */

        if ($user->hasRole('mahasiswa') && $user->mahasiswa) {
            $bimbingan = \App\Models\Bimbingan::where('mahasiswa_id', $user->mahasiswa->id)->first();
            $data['bimbingan_id'] = $bimbingan?->id;
        }
    
        // Pastikan status_verifikasi di-set jika tidak ada
        // if (!isset($data['status_verifikasi'])) {
        //     $data['status_verifikasi'] = 'belum diverifikasi';
        // }
    
        return $data;
    }
    
}
