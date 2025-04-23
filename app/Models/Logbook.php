<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    protected $guarded = ['id'];
    public function bimbingan()
    {
        return $this->belongsTo(Bimbingan::class);
    }
}
