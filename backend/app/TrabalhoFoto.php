<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrabalhoFoto extends Model
{

    protected $fillable = ['titulo', 'foto', 'trabalho_id'];

    public function trabalho()
    {
        return $this->belongsTo(Trabalho::class, 'trabalho_id', 'id');
    }
}
