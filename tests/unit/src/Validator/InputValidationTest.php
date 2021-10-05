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

    public function testNameEmpty()
    {
        $name = $this->inputValidation->name("");
        $this->assertEquals(1, $name);
    }

    public function testEmailTrue()
    {
        $email = $this->inputValidation->email("email@aa.tt");
        $this->assertEquals("email@aa.tt", $email);
        $this->assertSame("email@aa.tt", $email);
    }

    public function testEmailFalse()
    {
        $email = $this->inputValidation->email("email13133aa.tt");
        $this->assertEquals(false, $email);
    }

    public function testEmailEmpty()
    {
        $email = $this->inputValidation->email("");
        $this->assertEquals(1, $email);
    }

    public function testPhoneTrue()
    {
        $phone = $this->inputValidation->phone("831353258");
        $this->assertEquals("831353258",$phone);
        $this->assertSame("831353258", $phone);
    }

    public function testPhoneFalse()
    {
        $phone = $this->inputValidation->phone("not valid number");
        $this->assertEquals(false, $phone);
    }

    public function testPhoneEmpty()
    {
        $phone = $this->inputValidation->phone("");
        $this->assertEquals(1, $phone);
    }

    public function testDateTimeFalse()
    {
        $dateTime = $this->inputValidation->dateTime("2030.12.12 25:00");
        $this->assertEquals(false, $dateTime);
    }

    public function testDateTimeEmpty()
    {
        $dateTime = $this->inputValidation->dateTime("");
        $this->assertEquals(1, $dateTime);
    }

}