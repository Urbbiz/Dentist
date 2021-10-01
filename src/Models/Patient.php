<?php

namespace Dentist\Models;

class Patient
{
    public int $id;
    public string $nationalId;
    public string $name;
    public string $email;
    public string $phone;
    public ?string $dateTime;
}