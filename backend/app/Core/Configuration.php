<?php

namespace App\Core;

class Configuration
{

    private $user;

    public function __construct()
    {
        $conf = json_decode(file_get_contents(app()->basePath("configuracao.json")));

        $this->user = $conf->user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
