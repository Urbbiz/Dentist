<?php

namespace Dentist\App;

use Dentist\Database\DatabaseManager;
use Dentist\Database\ExportData;
use Dentist\IO\UserInputInterface;

class Application implements ApplicationInterface
{
    private  UserInputInterface $userInputReader;
    private  DatabaseManager $databaseManager;
    private ExportData $exportData;

    public function __construct(UserInputInterface $userInputReader, DatabaseManager $databaseManager, ExportData $exportData)
    {
       $this->userInputReader = $userInputReader;
       $this->databaseManager = $databaseManager;
       $this->exportData = $exportData;
    }

    public function run()
    {
        $input = trim(fgets(STDIN,10));
        switch ($input)
        {
            case 1:
                $this->register();
                break;
            case 2:
                $this->editAppointment();
                break;
            case 3:
                $this->deleteAppointment();
                break;
            case 4;
                $this->deleteAccount();
                break;
            case  5;
                $this->forMedicalPersonnel();
                break;
        }
    }

    private function register()
    {
        echo "Please enter your national ID number","\n";
        $nationalId = $this->userInputReader->getNationalId();
        if ($this->databaseManager->compareNationalIDwithDb($nationalId) == true){
            echo "You already have appointment. Go to section 2 --Edit appointment.";
        }else
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

            $this->databaseManager->addPatient($nationalId,$name,$email,$phone,$dateTime);
    }

    private function editAppointment()
    {
        echo "Please enter your national ID number for identification","\n";
        $nationalId = $this->userInputReader->getNationalId();
        if ($this->databaseManager->compareNationalIDwithDb($nationalId) == true){
            echo "your national ID number is $nationalId.","\n";

            echo"Please change appointment date and time","\n";
            $newDateTime = trim(fgets(STDIN, 20));
            $this->databaseManager->editDateTime($newDateTime, $nationalId);
            echo "New appointment date and time is: $newDateTime";
        }else
            Echo "You are not in our database. Please choose 1 from main menu, and create your appointment!";
    }

    private function deleteAppointment()
    {
        echo "Please enter your national ID number for identification, and your appointment will be deleted!","\n";
        $nationalId = $this->userInputReader->getNationalId();
        if ($this->databaseManager->compareNationalIDwithDb($nationalId) == true){
            $this->databaseManager->deleteDateTime($nationalId);
            echo "your appointment date and time deleted!!! If you want to set new appointment , go back and choose 2.","\n";
        }else
            Echo "Nothing to delete.You are not in our database!!!";
    }

    private function deleteAccount()
    {
        echo "Please enter your national ID number for identification, and your account will be deleted!","\n";
        $nationalId = $this->userInputReader->getNationalId();
        if ($this->databaseManager->compareNationalIDwithDb($nationalId) == true){
            $this->databaseManager->deletePatient($nationalId);
            echo "Account DELETED!","\n";
        }else
            Echo "Nothing to delete.You are not in our database!!!";
    }

    private function forMedicalPersonnel()
    {
        echo "You reached medical personnel data"."\n"."\n";
        echo "Choose what you want to do:"."\n";
        echo "Enter: 1 --Print data to this screen"."\n";
        echo "Enter: 2 --download data to CSV file "."\n";

        $input = trim(fgets(STDIN,10));
        if($input == 1) {
            echo "SEE ALL LIST OF PATIENTS" . "\n";
            $this->databaseManager->getAllData();
        } elseif ($input == 2) {
            $this->exportData->exportDataToCSV();
            echo "Your data downloaded successfully!";
        }else
            echo "You entered invalid input!!!";
    }

}