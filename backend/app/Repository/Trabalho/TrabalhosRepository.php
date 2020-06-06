<?php

namespace App\Repository\Trabalho;

use App\Trabalho;

class TrabalhoRepository
{

    public function insert(array $params): object
    {
        $trabalho = new Trabalho();
        $trabalho->fill($params);
        $trabalho->save();
        return $trabalho->id;
    }
}
