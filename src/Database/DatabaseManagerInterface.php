<?php

namespace Dentist\Database;

use Dentist\Models\Patient;

interface DatabaseManagerInterface
{
    public function addPatient($nationalId, $name, $email, $phone, $dateTime);

    public function getAllData():array;

    public function compareNationalIDwithDb($nationalId);

    public function getUserByNationalId($nationalId):?Patient;

    public function editDateTime($newDateTime, $nationalId);

    public function deleteDateTime($nationalId);

    public function deletePatient($nationalId): void;
}