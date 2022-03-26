<?php

namespace lewiscowles\core\Tests;

use lewiscowles\core\Concepts\Random\LcgRandomGenerator;
use lewiscowles\core\Concepts\Random\UlidRandomnessEncoder;
use lewiscowles\core\ValueTypes\PositiveNumber;
use PHPUnit\Framework\TestCase;

class RandomEncoderTest extends TestCase
{
    public function testRandomEncoderReturnsSpecifiedLength()
    {
        $sut = new UlidRandomnessEncoder(
            new LcgRandomGenerator()
        );
        $length = 12;
        $hash = $sut->encode(new PositiveNumber($length));
        $this->assertEquals($length, strlen($hash));
    }
}
