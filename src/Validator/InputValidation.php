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

    public function email($getEmail):string{
        if(filter_var($getEmail, FILTER_VALIDATE_EMAIL, FILTER_FLAG_EMAIL_UNICODE)){
            return $getEmail;
        }elseif ($getEmail == null){
            return 1;
        } else
            return false;
    }

    public function phone($getPhone, int $minDigits = 5, int $maxDigits = 10):string{
        if ($getPhone == null){
            return 1;
        }elseif (!preg_match('/^[0-9]{'.$minDigits.','.$maxDigits.'}\z/',$getPhone)){
            return false;
        } else
        return $getPhone;
    }

    public function dateTime($getDateTime){


        if($timestamp = $getDateTime==null) {
            return  1;
        }elseif (($timestamp = strtotime($getDateTime)) === false) {
            return false;
        }else {
            return date('c', $timestamp);
        }
    }

}