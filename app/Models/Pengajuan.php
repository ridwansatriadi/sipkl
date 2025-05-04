<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\SuratBalasan;
use App\Models\Mahasiswa;
use App\Models\Surat;
class Pengajuan extends Model
{
    protected $guarded = ['id'];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    public function surat_balasan()
    {
        return $this->hasOne(SuratBalasan::class);
    }

    public function surat()
    {
        return $this->hasOne(Surat::class);
    }

    // tambahkan forigenkey kaprodi 
    public function kaprodi()
    {
        return $this->belongsTo(Kaprodi::class);
    }

}
