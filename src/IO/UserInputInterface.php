<?php

namespace Dentist\IO;

interface UserInputInterface
{
    public function getNationalId(): string;

    public function getName(): string;

    public function getEmail(): string;

    public function getPhone(): string;

    public function getDateTime(): string;
}
