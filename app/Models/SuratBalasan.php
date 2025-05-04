<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengajuan;
class SuratBalasan extends Model
{
    protected $guarded = ['id'];
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }
    public function kaprodi()
    {
        return $this->belongsTo(Kaprodi::class);
    }

}
