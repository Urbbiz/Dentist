<?php

use src\App\Application;

require __DIR__.'/bootstrap.php';
require_once (__DIR__.'/vendor/autoload.php');


echo "Hello! Follow instructions below:","\n";
echo "Enter: 1 --Register new appointment. ","\n";
echo "Enter: 2 --Edit appointment.","\n";
echo "Enter: 3 --Delete appointment.","\n";
echo "Enter: 4 -- Only for medical personnel","\n";

$runApp = new Application();
$runApp->run();
//
//$input = trim(fgets(STDIN,10));
//
//switch ($input)
//{
//    case 1;
//        echo "Please enter your national ID number","\n";
//        $nationalId = trim(fgets(STDIN,1024));
//        echo "your national ID number is $nationalId.","\n";
//
//        echo "Enter your name","\n";
//        $name = trim(fgets(STDIN,50));
//        echo "your Name is: $name","\n";
//
//        echo "Enter your email","\n";
//        $email = trim(fgets(STDIN, 100));
//        echo "your email is: $email","\n";
//
//        echo "Enter your phone number","\n";
//        $phone = trim(fgets(STDIN, 50));
//        echo "your phone number is: $phone","\n";
//
//        echo "Enter appointment date and time","\n";
//        $dateTime = trim(fgets(STDIN, 20));
//        echo "Your appointment confirmed : $dateTime","\n";
//        break;
//
//    case 2;
//        echo "Please enter your national ID number for identification","\n";
//        $nationalId = trim(fgets(STDIN,1024));
//        echo "your national ID number is $nationalId.","\n";
//
//        echo"Please change appointment date and time","\n";
//        $newDateTime = trim(fgets(STDIN, 20));
//        echo "New appointment date and time is: $newDateTime";
//        break;
//
//    case 3;
//        echo "Please enter your national ID number for identification, and your appointment will be deleted!","\n";
//        $nationalId = trim(fgets(STDIN,1024));
//        echo "your national ID number is $nationalId.","\n";
//        break;
//
//    case  4;
//        echo "You reached medical personnel data";
//        break;
//
//}


