<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afegir1 extends Model
{
    use HasFactory;

    protected $table = 'afegir1'; // Especifica el nombre de la tabla

    protected $fillable = ['nom','etapa', 'descripcio', 'visible' ]; // Especifica los campos que pueden ser llenados
        // Definir la relación con Afegir2
        public function afegir2()
        {
            return $this->hasMany(Afegir2::class, 'id_curs', 'id');
        }
    
}
