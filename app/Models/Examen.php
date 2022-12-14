<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    use HasFactory;

    public function salle()
    {
        return $this->belongsTo(Salle::class);
    }
    public function modif()
    {
        return $this->belongsTo(Modif::class);
    }
    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }
    public function epreuve()
    {
        return $this->belongsTo(Epreuve::class);
    }
}
