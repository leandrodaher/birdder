<?php

namespace Birdder\App;

use Birdder\App\Repository\UserRepository;

class Utils
{
    static function printKeyValue(array $arr)
    {
        foreach ($arr as $key => $value) {
            echo "$key - $value {<br>";
            foreach ($value as $key2 => $value2) {
                echo "-    $key2: $value2<br>";
            }
            echo "}<br><br>";
        }
    }

    static function printUsers(UserRepository $userRepository)
    {
        foreach ($userRepository->findAll() as $key => $value) {
            echo $value->toHtml();
        }
    }
}