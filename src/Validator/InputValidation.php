<?php

namespace Dentist\Validator;


class InputValidation implements InputValidationInterface
{
    public function nationalId($getNationalId):string
    {
        if ($getNationalId == null){
            return 1;
        }elseif (!preg_match('~^[A-Z]{2}\d{11}$~',$getNationalId)){
            return false;
        } else {
            return $getNationalId;
        }
    }

    public function name($getName):string
    {
        if($getName == null){
            return 1;
        }elseif (!preg_match("/^[a-zA-Z-' ]{2,50}$/",$getName)){
            return false;
        }else
        return $getName;
    }

    public function email(){}

    public function phone(){}

    public function dateTime(){}
}