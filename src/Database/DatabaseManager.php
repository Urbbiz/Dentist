<?php

namespace Dentist\Database;

Use PDO;


class DatabaseManager extends Database
{
//PUT DATA TO DB
public function addPatient($getNationalId, $getName, $getEmail, $getPhone, $getDateTime)
{
    $statement = $this->connect()->prepare("INSERT INTO patient(nationalId,name,email,phone,datetime)VALUES  (?, ?, ?, ?, ?)");
    $statement->execute([$getNationalId, $getName, $getEmail, $getPhone, $getDateTime]);
}

}