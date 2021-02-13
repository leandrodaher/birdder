<?php

namespace Birdder\App\DAO;

class User
{
    public int $id;
    public string $name;
    public string $password;
    public string $profilename;
    public string $profilebio;

    public function __construct(string $name, string $password, string $profilename, string $profilebio)
    {
        unset($this->id);
        $this->name = $name;
        $this->password = $password;
        $this->profilename = $profilename;
        $this->profilebio = $profilebio;
    }

    public function toHtml(): string
    {
        $str = "User {$this->id} <br>
                --  Usuário: {$this->name} <br>
                --  Password: {$this->password} <br>
                --  Nome: {$this->profilename} <br>
                --  Bio: {$this->profilebio}
                <br><br>";


        return $str;
    }
}