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

    public function getNationalId(): string
    {
        $result = null;

        do {
            $nationalId = trim(fgets(STDIN, 1024));
            $result = $this->inputValidation->nationalId($nationalId);

            if ($result == false) {
                echo "Error! Id contains 2 capital Letters, ans 11 digits  LLXXXXXXXXXXX. Please try again:";
            } elseif ($result == 1) {
                echo "Error! You didn't enter national id.";
            }
        } while ($result == false || $result == 1);

        return $result;
    }

    public function getName(): string
    {
        do {
            $name = trim(fgets(STDIN, 50));
            $result = $this->inputValidation->name($name);
            if ($result == false) {
                echo "Minimum 2 symbols. Only letters and white spaces allowed! Try again. ";
            } elseif ($result == 1) {
                echo "Error! You didn't enter name.";
            }
        } while ($result == 1 || $result == false);
        return $result;
    }

    public function getEmail(): string
    {
        do {
            $email = trim(fgets(STDIN, 100));
            $result = $this->inputValidation->email($email);
            if ($result == false) {
                echo "Please enter valid email address and try again! ";
            } elseif ($result == 1) {
                echo "Error! You didn't enter email.";
            }
        } while ($result == false || $result == 1);
        return $result;
    }

    public function getPhone(): string
    {
        do {
            $phone = trim(fgets(STDIN, 100));
            $result = $this->inputValidation->phone($phone);
            if ($result == false) {
                echo "Error, use only numbers. Number length from 5 to 10 symbols!  ";
            } elseif ($result == 1) {
                echo "Error! You didn't enter phone number.";
            }
        } while ($result == false || $result == 1);
        return $result;
    }

    public function getDateTime(): string
    {
        $result = null;

        do {
            $input = trim(fgets(STDIN, 1024));
            $result =  $this->inputValidation->dateTime($input);
            if ($result == false) {
                echo "date format is incorrect! Use YYYY-MM-DD H:MM , Only numbers are allowed!";
            } elseif ($result == 1) {
                echo "Error! You didn't enter date and time.";
            }
        } while ($result == false || $result == 1);
        return $result;
    }
}
