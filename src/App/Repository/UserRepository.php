<?php

namespace Birdder\App\Repository;

use Birdder\App\Models\Users;
use Birdder\App\DAO\User;
use Exception;

class UserRepository
{
    private Users $usersModel;
    
    public function __construct(Users $usersModel)
    {
        $this->usersModel = $usersModel;
    }

    public function insert(User $user): bool
    {
        try {
            
            return $this->usersModel->insert($user->name, $user->password, $user->profilename, $user->profilebio);

        } catch (Exception $e) {
            throw $e;
            return false;
        }
    }

    public function findAll(): array
    {
        try {

            $fetch = $this->usersModel->findAll();
            return UserRepository::arrayKeyValueToUsers($fetch);
            //return $fetch;
        } catch (Exception $e) {
            throw $e;
            return null;
        }
    }


    // converte um array de dados de usuário (fonte: banco) para array de User (DAO)
    private static function arrayKeyValueToUsers(array $arr): array // Array de Usuários --> Array<User>
    {
        $users = [];

        foreach ($arr as $key => $value)
        {
            $userValues = [];
            foreach ($value as $key2 => $value2)
            {
                array_push($userValues, $value2);
            }
            $user = new User($userValues[1], $userValues[2], $userValues[3], $userValues[4]);
            $user->id = $userValues[0];
            array_push($users, $user);
            unset($user);
        }

        return $users;
    }
    
}