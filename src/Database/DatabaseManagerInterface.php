<?php

namespace Dentist\Database;

interface DatabaseManagerInterface
{
    public function addPatient($nationalId, $name, $email, $phone, $dateTime);

    public function getAllData();

    public function compareNationalIDwithDb($nationalId);

    public function editDateTime($newDateTime, $nationalId);

    public function deleteDateTime($nationalId);

    public function deletePatient($nationalId): void;
}