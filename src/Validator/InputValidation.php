<?php

namespace Dentist\Validator;

use Dentist\IO\UserInputReader;

class InputValidation implements InputValidationInterface
{
    public function nationalId($getNationalId)
    {
        if ($getNationalId == null){
            return 1;
        }elseif (!preg_match('~^[A-Z]{2}\d{11}$~',$getNationalId)){
            return false;
        } else {
            return $getNationalId;
        }
    }

    public function name(){}

    public function email(){}

    public function phone(){}

    public function dateTime(){}
}