<?php

namespace lewiscowles\core\Tests;

use DomainException;
use lewiscowles\core\ValueTypes\PositiveNumber;
use PHPUnit\Framework\TestCase;

class PositiveNumberTest extends TestCase
{
    public function testZeroIsValidPositiveNumber()
    {
        $output = new PositiveNumber(0);
        $this->assertEquals(0, $output->getValue());
    }

    public function testRandomPositiveNumber()
    {
        $randomPositiveNumber = rand(1, PHP_INT_MAX);
        $output = new PositiveNumber($randomPositiveNumber);
        $this->assertEquals($randomPositiveNumber, $output->getValue());
    }

    public function testAnyNegativeNumber()
    {
        $randomNegativeNumber = rand(PHP_INT_MIN, -1);
        $this->expectException(DomainException::class);
        new PositiveNumber($randomNegativeNumber);
    }
}
