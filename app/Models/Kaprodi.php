<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bimbingan;
class Kaprodi extends Model
{
    protected $guarded = ['id'];

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
    public function surat_balasan()
    {
        return $this->hasMany(SuratBalasan::class);
    }
    public function surat()
    {
        return $this->hasMany(Surat::class);
    }
    public function bimbingan()
    {
        return $this->hasMany(Bimbingan::class);
    }
}
