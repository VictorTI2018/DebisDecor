<?php

namespace App\Repository\TrabalhoFoto;

use App\TrabalhoFoto;

class TrabalhoFotoRepository
{

    public function insert(array $params, int $trabalhos_id)
    {
        $urlImage = '';
        foreach($params['fotos'] as $foto) {
            $urlImage .= $this->savePhoto($foto, $trabalhos_id) . ", ";
        }
        $urlImage = rtrim($urlImage, ", ");
        return explode(", ", $urlImage);
    }

    public function savePhoto($foto, int $trabalhos_id)
    {


        $time = time();
        $dirPai = 'trabalhos';
        $dirImage = $dirPai . DIRECTORY_SEPARATOR . 'trabalho_id_' . $trabalhos_id;
        $ext = substr($foto, 11, strpos($foto, ';') -11);
        $urlImage = $dirImage . DIRECTORY_SEPARATOR . $time . '.' . $ext;

        $file = str_replace('data:image/' . $ext . ';base64,', '', $foto);
        $file = base64_decode($file);

        if (!file_exists($dirPai)) {
            mkdir($dirPai, 0700);
        }
        if (!file_exists($dirImage)) {
            mkdir($dirImage, 0700);
        }

        file_put_contents($urlImage, $file);
        return $urlImage;
    }
}
