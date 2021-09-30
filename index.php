<?php

use Dentist\App\Application;
use Dentist\Database\DatabaseManager;
use Dentist\Database\ExportData;
use Dentist\IO\UserInputReader;
use Dentist\Validator\InputValidation;


require_once __DIR__.'/vendor/autoload.php';



$userInputReader = new UserInputReader(new InputValidation());
$databaseManager = new DatabaseManager();
$exportData = new ExportData();

us
$runApp = new Application($userInputReader, $databaseManager, $exportData);
$runApp->run();
