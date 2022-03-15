<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'idPost',
        'idUser',
        'comentario',
        'likes',
        'dislikes'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function likes()
    {
        return $this->hasMany(Reaction::class, 'idComment')->where('tipo', 1);
    }

    public function dislikes()
    {
        return $this->hasMany(Reaction::class, 'idComment')->where('tipo', 0);
    }

}
