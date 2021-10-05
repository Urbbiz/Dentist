<?php

namespace unit\src\IO;

use Dentist\Validator\InputValidationInterface;
use PHPUnit\Framework\TestCase;

class UserInputReaderTest extends TestCase
{
  public function testGetName():string
  {
      $fgets = $this->createMock(trim(fgets(STDIN, 50)));
      $inputValidation = $this->createMock(InputValidationInterface::class);

      $fgets->expects($this->once())->willReturn("Andrius");
      $result = $inputValidation->expects($this->once())->method("name")->willReturn("Andrius");
      $this->assertEquals("Andrius", $result);
  }
}