<?php

namespace Dentist\Models;

//use Dentist\Models\Appointment;

class Patient
{
    public int $id;
    public string $nationalId;
    public string $name;
    public string $email;
    public string $phone;
    public ?array $appointments = [];


//   public function __toString(): string
//    {
//        return $this->appointments;
//
//    }
}

