<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentes extends Model
{
    use HasFactory;

    /**
     * Obtine angajatii per departament
     */
    public function angajati()
    {
        return $this->hasMany(Angajatis::class);
    }
}
