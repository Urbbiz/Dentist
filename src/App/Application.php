<?php

namespace Dentist\App;

use Dentist\IO\UserInputInterface;


class Application implements ApplicationInterface
{
    private  UserInputInterface $userInputReader;

    public function __construct(UserInputInterface $userInputReader)
    {
       $this->userInputReader = $userInputReader;
    }

    public function run()
    {

        $input = trim(fgets(STDIN,10));

        switch ($input)
        {
            case 1;
                echo "Please enter your national ID number","\n";
                $nationalId = $this->userInputReader->getNationalId();
                echo "your national ID number is $nationalId.","\n";

                echo "Enter your name","\n";
                $name = $this->userInputReader->getName();
                echo "your Name is: $name","\n";

                echo "Enter your email","\n";
                $email = $this->userInputReader->getEmail();
                echo "your email is: $email","\n";

                echo "Enter your phone number","\n";
                $phone = $this->userInputReader->getPhone();
                echo "your phone number is: $phone","\n";

                echo "Enter appointment date and time","\n";
                $dateTime = $this->userInputReader->getDateTime();
                echo "Your appointment confirmed : $dateTime","\n";
                break;

            case 2;
                echo "Please enter your national ID number for identification","\n";
                $nationalId = $this->userInputReader->getNationalId();
                echo "your national ID number is $nationalId.","\n";

                echo"Please change appointment date and time","\n";
                $newDateTime = trim(fgets(STDIN, 20));
                echo "New appointment date and time is: $newDateTime";
                break;

            case 3;
//            TODO $newTime

                echo "Please enter your national ID number for identification, and your appointment will be deleted!","\n";
                $nationalId = $this->userInputReader->getNationalId();
                echo "your national ID number is $nationalId.","\n";
                break;

            case  4;
                echo "You reached medical personnel data";
                break;

        }
    }

}