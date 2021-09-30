<?php

namespace Dentist\Database;

use Dentist\Models\Patient;
use PDO;
use PDOException;
use phpDocumentor\Reflection\Types\Boolean;

class DatabaseManager  extends Database implements DatabaseManagerInterface
{
    public array $patients=[];
//PUT DATA TO DB
    public function addPatient($nationalId, $name, $email, $phone, $dateTime)
    {
        $statement = $this->connect()->prepare("INSERT INTO patient(nationalId,name,email,phone,datetime)VALUES  (?, ?, ?, ?, ?)");
        $statement->execute([$nationalId, $name, $email, $phone, $dateTime]);
    }

    public function getAllData():array
    {
        $sql = "SELECT * FROM patient";
        $statement = $this->connect()->query($sql);
        $patients = [];
        while ($row = $statement->fetch()) {
            $patient = new Patient();
            $patient->nationalId = $row['nationalId'];
            $patient->name = $row['name'];
            $patient->email = $row['email'];
            $patient->phone = $row['phone'];
            $patient->dateTime = $row['datetime'];
            $patients[] = $patient;
        }
        return $patients;
    }

    public function compareNationalIDwithDb($nationalId)
    {
        $sql = "SELECT id, nationalId FROM patient";
        $result = $this->connect()->query($sql);
        while ($row = $result->fetch()) {
            if ($row["nationalId"] == $nationalId) {
                return true;
            }
        }
    }

    public function getUserByNationalId($nationalId):?Patient
    {
        $statement = $this->connect()->prepare("SELECT * FROM patient WHERE nationalId=?");
        $statement->execute([$nationalId]);

        $row = $statement->fetch();
        if ($row != false){
            $patient = new Patient();
            $patient->nationalId = $row['nationalId'];
            $patient->name = $row['name'];
            $patient->email = $row['email'];
            $patient->phone = $row['phone'];
            $patient->dateTime = $row['datetime'];
            return $patient;
        }
        return null;
    }

    public function editDateTime($newDateTime, $nationalId)
    {
//    $sql = "UPDATE patient SET datetime=? WHERE nationalId='$nationalId'";
        $statement = $this->connect()->prepare("UPDATE patient SET datetime=? WHERE nationalId=?");
        $statement->execute([$newDateTime, $nationalId]);
    }


    public function deleteDateTime($nationalId)
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
}
