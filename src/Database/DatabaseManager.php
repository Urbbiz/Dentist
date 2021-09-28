<?php

namespace Dentist\Database;

Use PDO;
use PDOException;
use phpDocumentor\Reflection\Types\Boolean;


class DatabaseManager extends Database
{
//PUT DATA TO DB
public function addPatient($nationalId, $name, $email, $phone, $dateTime)
{
    $statement = $this->connect()->prepare("INSERT INTO patient(nationalId,name,email,phone,datetime)VALUES  (?, ?, ?, ?, ?)");
    $statement->execute([$nationalId, $name, $email, $phone, $dateTime]);
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

public function deletePatient($nationalId)
{
    try {
        $sql = "DELETE FROM patient WHERE nationalId ='$nationalId'";

        $this->connect()->exec($sql);
        echo "Patient deleted successfully";
    } catch (PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }


}
}