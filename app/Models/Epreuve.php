<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Epreuve extends Model
{
    use HasFactory;
    public function formations()
    {
        return $this->belongsToMany(Formation::class);
    }
    public function examens()
    {
        return $this->belongsToMany(Examen::class);
    }
}
