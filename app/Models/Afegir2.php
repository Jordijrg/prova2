<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afegir2 extends Model
{
    use HasFactory;
    protected $table = 'afegir2'; // Especifica el nombre de la tabla
    protected $fillable = ['titol', 'contingut', 'visible','id_curs']; // Especifica los campos que pueden ser llenados
        // Definir la relación con Afegir1
        public function afegir1()
        {
            return $this->belongsTo(Afegir1::class, 'id_curs', 'id');
        }
    
}
