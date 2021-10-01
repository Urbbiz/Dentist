<?php

use Dentist\App\Application;
use Dentist\Database\DatabaseManager;
use Dentist\Export\CsvWriter;
use Dentist\IO\UserInputReader;
use Dentist\Validator\InputValidation;


require_once __DIR__.'/vendor/autoload.php';



$userInputReader = new UserInputReader(new InputValidation());
$databaseManager = new DatabaseManager();
$csvWriter = new CsvWriter();


$app = new Application($userInputReader, $databaseManager, $csvWriter);
$app->run();
