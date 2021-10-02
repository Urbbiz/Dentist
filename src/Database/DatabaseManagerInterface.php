<?php

namespace Dentist\Database;

use Dentist\Models\Patient;

interface DatabaseManagerInterface
{
    public function addPatient($nationalId, $name, $email, $phone, $dateTime);

    public function addAppointment($nationalId, $dateTime);

    public function getAllData():array;

    public function getUserByNationalId($nationalId):?Patient;

    public function editDateTime($newDateTime, $nationalId):void;

    public function deleteAppointment($patientId): void;

    public function deletePatient($nationalId): void;

    public function deleteAllPatients():void;
}