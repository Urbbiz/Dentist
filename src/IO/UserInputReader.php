<?php

namespace Dentist\IO;


class UserInputReader implements UserInputInterface
{

    public function getNationalId():string
    {
        $nationalId = trim(fgets(STDIN,1024));

        return $nationalId;
    }

    public function getName() :string
    {
        $name = trim(fgets(STDIN,50));

        return $name;
    }

    public function getEmail():string
    {
        $email = trim(fgets(STDIN, 100));
        return $email;
    }

    public  function  getPhone():string
    {
        $phone = trim(fgets(STDIN, 50));

        return $phone;
    }

    public function getDateTime():string
    {
        $dateTime = trim(fgets(STDIN, 20));
        return $dateTime;
    }
}