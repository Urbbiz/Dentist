<?php

namespace unit\src\Validator;

use PHPUnit\Framework\TestCase;

class InputValidationProvider extends TestCase
{

   public static function testNameProviderFalse()
    {
        return [
            ["LT11111111111111111"],
            ["letters646456"],
            [1],
            [true],
        ];
    }

}