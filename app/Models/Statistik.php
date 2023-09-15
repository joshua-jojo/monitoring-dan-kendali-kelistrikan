<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistik extends Model
{
    use HasFactory;

    function perangkat()
    {
        return $this->belongsTo(Perangkat::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
}
