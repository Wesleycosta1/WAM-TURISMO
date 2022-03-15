<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = [
        'idUser',
        'idPost',
        'type',
    ];

    public function post(){
        return $this->belongsTo(Post::class, 'idPost');
    }

}
