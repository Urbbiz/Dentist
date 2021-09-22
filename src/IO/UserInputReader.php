<?php

namespace Dentist\IO;


use Dentist\Validator\InputValidation;
use Dentist\Validator\InputValidationInterface;

class UserInputReader implements UserInputInterface
{
 private InputValidationInterface $inputValidation;

    public function __construct(InputValidationInterface $inputValidation)
    {
        $this->inputValidation = $inputValidation;
    }

    public function getNationalId():string
    {
        $result = null;

        do{
            $nationalId = trim(fgets(STDIN,1024));
            $result = $this->inputValidation->nationalId($nationalId);

            if($result == false) {
                echo "Only letters and white space allowed! try again: ";
            }elseif ($result == 1){
                echo "Error! You didn't enter name.";
            }
        }while($result == false || $result == 1);

        return $result;
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