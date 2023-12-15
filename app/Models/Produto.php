<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'imagem',
        'slug',
        'id_categoria',
        'id_user',
    ];

    // se a model não conseguir se relacionar com o table do bd, defina o nome da table
    protected $table = 'produtos';


    // Retorna o user a qual o produto pertence
    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    // Retorna a categoria a qual o produto pertence
    public function categoria(){
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
