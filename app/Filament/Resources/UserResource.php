<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use CWSPS154\UsersRolesPermissions\UsersRolesPermissionsPlugin;
use Filament\Facades\Filament;


class UserResource extends Resource
{
    
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationLabel(): string
{
    $user = Filament::auth()->user();
      /** @var \App\Models\User $user */

    if ($user && $user->hasRole('kaprodi')) {
        return 'Kelola Akun ';
    }

    return 'User'; // Label default jika bukan kaprodi
}
 
    public static function form(Form $form): Form
    {

        $currentUser = User::find(Filament::auth()->id());
        $isKaprodi = $currentUser && $currentUser->hasRole('kaprodi');

    return $form
        ->schema([
            Forms\Components\TextInput::make('name')
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('email')
                ->email()
                ->required()
                ->maxLength(255),
            Forms\Components\TextInput::make('password')
                ->password()
                ->required()
                ->maxLength(255),
            Forms\Components\Select::make('roles')
                ->relationship('roles', 'name', function (Builder $query) use ($isKaprodi) {
                    if ($isKaprodi) {
                        $query->whereIn('name', ['mahasiswa', 'dpl']);
                    }
                })
                ->multiple()
                ->preload()
                ->searchable(),
        ]);
    }

    public static function table(Table $table): Table
{
    // Cek apakah user yang login adalah Kaprodi
    $currentUser = User::find(Filament::auth()->id());
    $isKaprodi = $currentUser && $currentUser->hasRole('kaprodi');
    
    return $table
        ->columns([
            Tables\Columns\TextColumn::make('name')
                ->label('Nama')
                ->searchable(),
            Tables\Columns\TextColumn::make('email')
                ->label('Email')
                ->searchable(),
            Tables\Columns\TextColumn::make('password')
                ->label('Password')
                ->searchable(),
            Tables\Columns\TextColumn::make('role')
                ->label('Role')
                ->searchable()
                ->formatStateUsing(function ($state) {
                    return $state ? ucfirst($state) : '-';  // Capitalize role name
                }),
        ])
        ->filters([
            Tables\Filters\SelectFilter::make('role')
            
                ->label('Role')
                ->options(function () {
                    /** @var \App\Models\User $user */

                    $user = Filament::auth()->user();
        
                    if ($user->hasRole('kaprodi')) {
                        return [
                            'mahasiswa' => 'Mahasiswa',
                            'dpl' => 'DPL',
                        ];
                    }
        
                    if ($user->hasRole('admin')) {
                        return [
                            'admin' => 'Admin',
                            'kaprodi' => 'Kaprodi',
                            'mahasiswa' => 'Mahasiswa',
                            'dpl' => 'DPL',
                        ];
                    }
        
                    // Default (misal untuk role lain)
                    return User::distinct()->pluck('role', 'role')->toArray();
                })
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
    public static function getPluralModelLabel(): string
    {
        return 'User'; // Supaya tidak jadi "Mahasiswas"
    }

    public static function getEloquentQuery(): Builder
    {
             /** @var \App\Models\User $user */

        $user = Filament::auth()->user();
    
        if ($user && $user->hasRole('kaprodi') && $user->kaprodi) {
            $prodiId = $user->kaprodi->prodi_id;
    
            return parent::getEloquentQuery()
                ->where(function ($query) use ($prodiId) {
                    $query->whereHas('mahasiswa', function ($q) use ($prodiId) {
                        $q->where('prodi_id', $prodiId);
                    })->orWhereHas('dpl.bimbingans.mahasiswa', function ($q) use ($prodiId) {
                        $q->where('prodi_id', $prodiId);
                    });
                });
        }
    
        return parent::getEloquentQuery();
    }

}
