<?php

namespace Dentist\Database;

use PDO;
use PDOException;
use phpDocumentor\Reflection\Types\Boolean;

class DatabaseManager  extends Database implements DatabaseManagerInterface
{
//PUT DATA TO DB
    public function addPatient($nationalId, $name, $email, $phone, $dateTime)
    {
        $statement = $this->connect()->prepare("INSERT INTO patient(nationalId,name,email,phone,datetime)VALUES  (?, ?, ?, ?, ?)");
        $statement->execute([$nationalId, $name, $email, $phone, $dateTime]);
    }

    public function getAllData()
    {
        $sql = "SELECT * FROM patient";
        $result = $this->connect()->query($sql);
        while ($row = $result->fetch()) {
            echo "ID:" . $row["nationalId"] . ". NAME:" . $row["name"] . ". EMAIL:" . $row["email"] . ". PHONE:" . $row["phone"] . ". DATE AND TIME:" . $row["datetime"] . "\n";
        }
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
