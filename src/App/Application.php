<?php

namespace Dentist\App;

use Dentist\Database\DatabaseManagerInterface;
use Dentist\Export\CsvWriterInterface;
use Dentist\IO\UserInputInterface;

class Application implements ApplicationInterface
{
    private UserInputInterface $userInputReader;
    private DatabaseManagerInterface $databaseManager;
    private CsvWriterInterface $csvWriter;

    public function __construct(UserInputInterface $userInputReader, DatabaseManagerInterface $databaseManager, CsvWriterInterface $csvWriter)
    {
        $this->userInputReader = $userInputReader;
        $this->databaseManager = $databaseManager;
        $this->csvWriter = $csvWriter;
    }

    public function run():void
    {
        echo "Hello! Follow instructions below:", "\n";
        do {
            $this->showMenu();
            $input = trim(fgets(STDIN, 10));
            switch ($input) {
                case 1:
                    $this->register();
                    break;
                case 2:
                    $this->addAppointment();
                    break;
                case 3:
                    $this->deleteAppointment();
                    break;
                case 4;
                    $this->deleteAccountAndAppointments();
                    break;
                case 5;
                    $this->forMedicalPersonnel();
                    break;
                case 6;
                    echo "BYE!!!";
                    break;
            }
        }while($input != 6);
        }

    private function register():void
    {
        echo "Please enter your national ID number","\n";
        $nationalId = $this->userInputReader->getNationalId();
        $userByNationalId = $this->databaseManager->getUserByNationalId($nationalId);
            if ( $userByNationalId !=null ) {
            echo "You already have appointment at:" .$userByNationalId."! Go to section 2 --Edit appointment.";
        } else {
            echo "your national ID number is $nationalId.", "\n";

            echo "Enter your name", "\n";
            $name = $this->userInputReader->getName();
            echo "your Name is: $name", "\n";

            echo "Enter your email", "\n";
            $email = $this->userInputReader->getEmail();
            echo "your email is: $email", "\n";

            echo "Enter your phone number", "\n";
            $phone = $this->userInputReader->getPhone();
            echo "your phone number is: $phone", "\n";

            echo "Enter appointment date and time", "\n";
            $dateTime = $this->userInputReader->getDateTime();
            echo "Your appointment confirmed : $dateTime", "\n";

            $this->databaseManager->addPatient($nationalId, $name, $email, $phone, $dateTime);
        }
    }

    private function addAppointment():void
    {
        echo "Please enter your national ID number for identification","\n";
        $nationalId = $this->userInputReader->getNationalId();
        $userByNationalId = $this->databaseManager->getUserByNationalId($nationalId);
        if ($userByNationalId !=null) {
            echo "your appointments: " . "\n";
            $appointments = $userByNationalId->appointments;
            foreach ($appointments as $key => $appointment) {
                $index = $key+1;
                echo "No: $index. date and time: $appointment.", "\n";
            }
            echo"Please add new appointment date and time","\n";
            $newDateTime = trim(fgets(STDIN, 20));
            $this->databaseManager->addAppointment($nationalId, $newDateTime);
            echo "New appointment date and time is: $newDateTime" . "\n";
        } else {
            echo "You are not in our database. Please choose 1 from main menu, and create your appointment!"."\n";
        }
    }

    private function showMenu():void
    {
        echo "Enter: 1 --Register new user and first appointment. ", "\n";
        echo "Enter: 2 --Add new appointment.", "\n";
        echo "Enter: 3 --Delete appointments.", "\n";
        echo "Enter: 4 --Delete account.", "\n";
        echo "Enter: 5 -- Only for medical personnel", "\n";
        echo "Enter: 6 -- QUIT", "\n";
    }
    private function deleteAppointment():void
    {
        echo "Please enter your national ID number for identification, and your appointments will be deleted!","\n";
        $nationalId = $this->userInputReader->getNationalId();
        $userByNationalId = $this->databaseManager->getUserByNationalId($nationalId);
        $patientId = $userByNationalId->id;
        if ($userByNationalId !=null) {
            $this->databaseManager->deleteAppointment($patientId);
            echo "your appointment date and time deleted!!! If you want to set new appointment , go back and choose 2.","\n";
        } else {
            echo "Nothing to delete.You are not in our database!!!";
        }
    }

    private function deleteAccountAndAppointments():void
    {
        echo "Please enter your national ID number for identification, and your account will be deleted!","\n";
        $nationalId = $this->userInputReader->getNationalId();
        $userByNationalId = $this->databaseManager->getUserByNationalId($nationalId);
        $patientId = $userByNationalId->id;
        if ($userByNationalId !=null) {
            $this->databaseManager->deleteAppointment($patientId);
            $this->databaseManager->deletePatient($nationalId);
            echo "Account DELETED!","\n";
        } else {
            echo "Nothing to delete.You are not in our database!!!";
        }
    }

    private function forMedicalPersonnel():void
    {
        echo "You reached medical personnel data" . "\n" . "\n";
        echo "Choose what you want to do:" . "\n";
        echo "Enter: 1 --Print data to this screen" . "\n";
        echo "Enter: 2 --download data to CSV file " . "\n";
        echo "Enter: 3 --DELETE all patients list " . "\n";

        $input = trim(fgets(STDIN, 10));
        switch ($input){
            case 1:
                echo "SEE ALL LIST OF PATIENTS" . "\n";
                $patients = $this->databaseManager->getAllData();
                foreach ($patients as $patient) {
                    echo "ID:" . $patient->nationalId . ". NAME:" . $patient->name . ". EMAIL:" . $patient->email . ". PHONE:" . $patient->phone."\n";
                    foreach ($patient->appointments as $key=> $appointment) {
                        $index = $key+1;
                                echo "No: $index. DATE AND TIME:" . $appointment . "\n";
                        }
                }
                break;
            case 2:
                $patients = $this->databaseManager->getAllData();
                $this->csvWriter->exportDataToCSV($patients);
                echo "Your data downloaded successfully!";
                break;
            case 3:
                $this->databaseManager->deleteAllPatientsAndAppointments();
                    echo "All patients deleted!!!!";
                break;
        }
    }
}
