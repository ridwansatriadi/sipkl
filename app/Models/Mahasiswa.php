<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Bimbingan;

class Mahasiswa extends Model
{
    protected $guarded = ['id'];
    
    // protected $table = 'mahasiswa'; // jika nama tabel beda dari default

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }

    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class);
    }
 
    
}
