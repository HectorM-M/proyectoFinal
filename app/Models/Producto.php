<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Nombre de la tabla en phpMyAdmin 
    protected $table = 'productos';

    // Esto permite que Laravel guarde los datos en el formulario
    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'categoria'
    ];
}