<?php

namespace Dentist\Validator;

interface InputValidationInterface
{
  public function nationalId($getNationalId);

  public function name();

  public function email();

  public function phone();

  public function dateTime();
}