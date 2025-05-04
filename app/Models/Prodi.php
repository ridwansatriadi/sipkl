<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $guarded = ['id'];

    public function mahasiswas()
    {
        return $this->hasMany(Mahasiswa::class);
    }

    public function kaprodis()
    {
        return $this->hasOne(Kaprodi::class);
    }
}
