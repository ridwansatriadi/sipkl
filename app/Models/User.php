<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;


use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use App\Models\Kaprodi;
use App\Models\Mahasiswa;
use App\Models\Dpl;
use Spatie\Permission\Traits\HasRoles;

/**
 * @method bool hasRole(string|array $roles)
 * @method bool hasAnyRole(string|array $roles)
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany roles()
 */

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    //     public function canAccessPanel(Panel $panel): bool
    // {
    //     return match ($panel->getId()) {
    //         'admin' => $this->role === 'admin',
    //         default => false,
    //     };
    // }

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class);
    }

    public function dpl()
    {
        return $this->hasOne(Dpl::class);
    }

    

}