<?php

namespace App\Repository\User;

use App\User;

class UserRepository
{

    /**
     * Buscar por uma chave e valor
     *
     * @param string $key
     * @param string|int $value
     * @return object
     */
    public function find(string $key, $value): object
    {
        return (new User())
            ->query()
            ->where("{$key}", $value)
            ->first();
    }

    /**
     * Inserir um usuario
     *
     * @param array $params
     * @return boolean
     */
    public function insert(array $params): bool
    {
        return (new User())->fill($params)->save();
    }

    public function edit($id, array $params): bool
    {
        return (new User())
            ->query()
            ->where("id", $id)
            ->update($params);
    }
}
