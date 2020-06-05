<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabalho extends Model {

    protected $fillable = [
        'nome', 'descricao', 'user_id'
    ];
}