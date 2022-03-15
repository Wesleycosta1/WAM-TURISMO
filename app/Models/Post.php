<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'estado',
        'cidade',
        'titulo',
        'descricao',
        'avaliacao',
        'nomeCidade',
        'nomeEstado',
        'fotos'
    ];


    public function images()
    {
        return $this->hasMany(Image::class, 'idPost');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'idPost')->orderBy('created_at', 'DESC');
    }

    public function owner(){
        return $this->belongsTo(User::class, 'idUser');
    }

    public function queroIr(){
        return $this->hasMany(Interest::class, 'idPost')->where('type', 1);
    }

    public function jaFui(){
        return $this->hasMany(Interest::class, 'idPost')->where('type', 2);
    }

    public function naoIriaNovamente(){
        return $this->hasMany(Interest::class, 'idPost')->where('type', 3);
    }

}
