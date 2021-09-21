<?php

use Dentist\App\Application;
use Dentist\IO\UserInputReader;


require_once __DIR__.'/vendor/autoload.php';

$userInputReader = new UserInputReader();


echo "Hello! Follow instructions below:","\n";
echo "Enter: 1 --Register new appointment. ","\n";
echo "Enter: 2 --Edit appointment.","\n";
echo "Enter: 3 --Delete appointment.","\n";
echo "Enter: 4 -- Only for medical personnel","\n";

$runApp = new Application($userInputReader);
$runApp->run();
