<?php

namespace Dentist\Database;

Use PDO;
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
}