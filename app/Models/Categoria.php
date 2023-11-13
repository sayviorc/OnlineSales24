<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table= 'Categorias';
    protected $primaryKey = 'Id_categoria';
    public $timestamps = false;

    protected $fillable = ['Categoria','Descripcion','Estatus'];
}
