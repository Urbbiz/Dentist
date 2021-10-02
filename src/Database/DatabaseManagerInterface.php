<?php

namespace Dentist\Database;

use Dentist\Models\Patient;

interface DatabaseManagerInterface
{
    public function addPatient($nationalId, $name, $email, $phone, $dateTime):void;

    public function addAppointment($nationalId, $dateTime):void ;

    public function getAllData():array;

    public function getUserByNationalId($nationalId):?Patient;

    public function deleteAppointment($patientId): void;

    public function deletePatient($nationalId): void;

    public function deleteAllPatientsAndAppointments(): void;
}