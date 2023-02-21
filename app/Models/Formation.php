<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    public function epreuves()
    {
        return $this->belongsToMany(Epreuve::class);
    }
    public function examens()
    {
        return $this->belongsTo(Examen::class);
    }
}
