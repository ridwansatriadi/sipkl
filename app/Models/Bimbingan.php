<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;
use App\Models\Dpl;
class Bimbingan extends Model
{
    protected $guarded = ['id'];
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class,'mahasiswa_id');
    }

    public function dpl()
    {
        return $this->belongsTo(Dpl::class,'dpl_id');
    }
    public function kaprodi()
    {
        return $this->belongsTo(Kaprodi::class,'dpl_id');
    }

    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }

    public function laporan()
    {
        return $this->hasOne(Laporan::class);
    }

    public function nilai()
    {
        return $this->hasOne(Nilai::class);
    }

}
