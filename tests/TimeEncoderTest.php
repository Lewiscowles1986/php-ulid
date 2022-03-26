<?php

namespace lewiscowles\core\Tests;

use lewiscowles\core\TimeEncoderInterface;
use lewiscowles\core\UlidTimeEncoder;
use lewiscowles\core\ValueTypes\PositiveNumber;
use PHPUnit\Framework\TestCase;

class TimeEncoderTest extends TestCase
{
    const TIME = 1469918176385;

    public function getTimeEncoder(): TimeEncoderInterface
    {
        return new UlidTimeEncoder();
    }

    public function testEncodeTimeShouldReturnExpectedEncodedResult()
    {
        $hash = $this->getTimeEncoder()->encode(self::TIME, new PositiveNumber(10));
        $this->assertEquals("01ARYZ6S41", $hash);
    }

    public function testEncodeTimeShouldChangeLengthProperly()
    {
        $hash = $this->getTimeEncoder()->encode(self::TIME, new PositiveNumber(12));
        $this->assertEquals("0001ARYZ6S41", $hash);
    }

    public function testEncodeTimeShouldTruncateTimeIfNotLongEnough()
    {
        $hash = $this->getTimeEncoder()->encode(self::TIME, new PositiveNumber(8));
        $this->assertEquals("ARYZ6S41", $hash);
    }
}
