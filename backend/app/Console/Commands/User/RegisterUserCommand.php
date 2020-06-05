<?php

namespace App\Console\Commands\User;

use App\Core\Configuration;
use App\User;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RegisterUserCommand extends Command
{

    protected $signature = 'register:user';

    protected $description = 'Criar um novo usuario';

    public function handle()
    {
        try {
            $users = (new Configuration())->getUser();
            $existsEmails = [];
            $userModel = new User();
            $this->info("Iniciando Registros");
            foreach ($users as $user) {
                $this->info('Verificando se usuario já existe...');
                if ($userModel->query()->where("email", $user->email)->first()) {
                    array_push($existsEmails, $user->email);
                } else {
                    $userModel->username = $user->username;
                    $userModel->email = $user->email;
                    $userModel->password =  Hash::make($user->password);
                    $userModel->save();
                }
            }
            if (count($existsEmails) > 0) {
                foreach ($existsEmails as $email) {
                    $this->info("E-mails cadastrados: " . $email . " ");
                    $this->info("Total de E-mail cadastrados => " . count($existsEmails));
                }
            }

            $this->info("Rotina finalizada com sucesso");
        } catch (Exception $e) {
            $this->error("Erro ao se cadastrar: {$e->getMessage()}");
        }
    }
}
