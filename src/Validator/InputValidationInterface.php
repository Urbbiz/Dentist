<?php

namespace Dentist\Validator;

interface InputValidationInterface
{
  public function nationalId($getNationalId):string;

  public function name($getName):string;

  public function email($getEmail):string;

  public function phone($getPhone):string;

  public function dateTime($getDateTime);
}