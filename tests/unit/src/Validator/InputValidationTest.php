<?php

namespace unit\src\Validator;

use Dentist\IO\UserInputReader;
use Dentist\Validator\InputValidation;
use Dentist\Validator\InputValidationInterface;
use PHPUnit\Framework\TestCase;
use unit\src\Validator;

class InputValidationTest extends TestCase
{

    protected object $inputValidation;

    public function setUp(): void
    {
        $this->inputValidation = new InputValidation();

    }

    public function testNationalIdFalseProvider()
    {
        return [
            ["LT11111111111111111"],
            ["letters"],
            [1],
            [true],
            [" "]
        ];
    }

    public function testNationalIdTrueProvider()
    {
        return [
            ["LT11111111111"],
            ["LT23232323232"],
            ["LT00000000000"],
        ];
    }

    /**
     * @dataProvider testNationalIdFalseProvider
     */
    public function testNationalIdFalse($getNationalId)
    {
        $nationalId = $this->inputValidation->nationalId($getNationalId);
        $this->assertEquals(false, $nationalId);

    }

    /**
     * @dataProvider testNationalIdTrueProvider
     */
    public function testNationalIdTrue($getNationalId)
    {
        $nationalId = $this->inputValidation->nationalId($getNationalId);
        $this->assertEquals($nationalId, $nationalId);
        $this->assertSame($getNationalId, $nationalId);
    }

    public function testNationalIdNull()
    {
        $nationalId = $this->inputValidation->nationalId("");
        $this->assertEquals(1, $nationalId);
    }


    public function testNameTrue()
    {
        $name = $this->inputValidation->name("Andrius Molingas");
        $this->assertEquals("Andrius Molingas", $name);
    }



    public function testNameFalse()
    {
        $name = $this->inputValidation->name("1233132");
        $this->assertEquals(false, $name);
    }

}