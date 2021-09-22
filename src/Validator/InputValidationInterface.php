<?php

namespace Dentist\Validator;

interface InputValidationInterface
{
  public function nationalId($getNationalId):string;

  public function name($getName):string;

  public function email();

  public function phone();

  public function dateTime();
}