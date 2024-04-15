<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Afegir2 extends Model
{
    use HasFactory;
    protected $table = 'afegir2'; // Especifica el nombre de la tabla
    protected $fillable = ['titol', 'contingut', 'visible','id_curs']; // Especifica los campos que pueden ser llenados
    
}
