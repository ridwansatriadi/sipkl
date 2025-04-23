<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bimbingan;
use App\Models\User;
class Dpl extends Model
{
    protected $guarded = ['id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bimbingans()
    {
        return $this->hasMany(Bimbingan::class);
    }
    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }
    public function laporans()
    {
        return $this->hasMany(laporan::class);
    }
    public function nilais()
    {
        return $this->hasMany(Nilai::class);
    }
   
}
