<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Angajatis extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_departament',
        'nume',
        'prenume',
        'cnp',
        'functie',
        'salariu',
        'zile concediu',
    ];

    /**
    * Obtine departamentul per angajat.
    */
    public function departamente()
    {
        return $this->belongsTo(Departamentes::class);
    }
}
