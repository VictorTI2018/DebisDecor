<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model
{

    protected $fillable = [
        'nome', 'descricao', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function trabalhosFotos()
    {
        return $this->hasMany(TrabalhoFoto::class, 'id', 'trabalho_id');
    }
}
