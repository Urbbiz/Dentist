<?php

namespace Dentist\Database;

Use PDO;


class DatabaseManager extends Database
{
//PUT DATA TO DB
public function addPatient($nationalId, $name, $email, $phone, $dateTime)
{
    $statement = $this->connect()->prepare("INSERT INTO patient(nationalId,name,email,phone,datetime)VALUES  (?, ?, ?, ?, ?)");
    $statement->execute([$nationalId, $name, $email, $phone, $dateTime]);
}

}