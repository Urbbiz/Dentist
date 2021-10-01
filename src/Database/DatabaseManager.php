<?php

namespace Dentist\Database;

use Dentist\Models\Appointment;
use Dentist\Models\Patient;

class DatabaseManager  extends Database implements DatabaseManagerInterface
{
    public array $patients=[];
//PUT DATA TO DB
//    public function addPatient($nationalId, $name, $email, $phone, $dateTime)
//    {
//        $statement = $this->connect()->prepare("INSERT INTO patient(nationalId,name,email,phone,datetime)VALUES  (?, ?, ?, ?, ?)");
//        $statement->execute([$nationalId, $name, $email, $phone, $dateTime]);
//    }

    public function addPatient($nationalId, $name, $email, $phone, $dateTime)
    {
        $statement = $this->connect()->prepare("INSERT INTO patient(nationalId,name,email,phone) VALUES  (?, ?, ?, ?)");
        $statement->execute([$nationalId, $name, $email, $phone]);

        $patient =$this->getUserByNationalId($nationalId);
        $statement = $this->connect()->prepare("INSERT INTO appointments(datetime,patientID) VALUES  (?,?)");
        $statement->execute([$dateTime,$patient->id]);


    }

    public function getUserByNationalId($nationalId):?Patient
    {
        $statement = $this->connect()->prepare("SELECT * FROM patient WHERE nationalId=?");
        $statement->execute([$nationalId]);

        $row = $statement->fetch();
        if ($row != false){
            $patient = new Patient();
            $patient->id = $row['id'];
            $patient->nationalId = $row['nationalId'];
            $patient->name = $row['name'];
            $patient->email = $row['email'];
            $patient->phone = $row['phone'];
            $patient->dateTime = $row['datetime'];
            return $patient;
        }
        return null;
    }

//    public function getAllData():array
//    {
//        $sql = "SELECT * FROM patient ORDER BY datetime ASC";
//        $statement = $this->connect()->query($sql);
//        $patients = [];
//        while ($row = $statement->fetch()) {
//            $patient = new Patient();
//            $patient->nationalId = $row['nationalId'];
//            $patient->name = $row['name'];
//            $patient->email = $row['email'];
//            $patient->phone = $row['phone'];
//            $patient->dateTime = $row['datetime'];
//            $patients[] = $patient;
//        }
//        return $patients;
//    }

    public function getAllData():array
    {

        $sql = "SELECT * FROM appointments";
        $statement = $this->connect()->query($sql);

        $appointments = [];
        $patients = [];

        while ($row = $statement->fetch()) {
            $appointment = new Appointment();
            $appointment->id = $row['ID'];
            $appointment->dateTime = $row['datetime'];
            $appointment->patientId = $row['patientID'];
            $appointments[] = $appointment;
        }
        $sql = "SELECT * FROM patient";
        $statement = $this->connect()->query($sql);

        while ($row = $statement->fetch()) {
            $patient = new Patient();
            $patient->nationalId = $row['nationalId'];
            $patient->name = $row['name'];
            $patient->email = $row['email'];
            $patient->phone = $row['phone'];
            foreach ($appointments as $appointment) {
                if ($patient->id = $appointment->patientId) {
                    $patient->appointments[] = $appointment->dateTime;
                }
            }
            $patients[] = $patient;
        }
        var_dump($patients);
        return $patients;

    }



    public function editDateTime($newDateTime, $nationalId):void
    {
//    $sql = "UPDATE patient SET datetime=? WHERE nationalId='$nationalId'";
        $statement = $this->connect()->prepare("UPDATE patient SET datetime=? WHERE nationalId=?");
        $statement->execute([$newDateTime, $nationalId]);
    }


    public function deleteDateTime($nationalId):void
    {
        $statement = $this->connect()->prepare("UPDATE patient SET datetime=NULL WHERE nationalId=?");
        $statement->execute([$nationalId]);
    }

    public function deletePatient($nationalId): void
    {
        $sql = "DELETE FROM patient WHERE nationalId ='$nationalId'";
        $this->connect()->exec($sql);
        echo "Patient deleted successfully";
    }

    public function deleteAllPatients():void
    {
        $statement = $this->connect()->prepare("DELETE FROM patient");
        $statement->execute();
    }
}
