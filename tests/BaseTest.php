<?php

namespace lewiscowles\core\Tests;

use lewiscowles\core\Ulid;
use lewiscowles\core\LcgRandomGenerator;
use lewiscowles\core\PHPTimeSource;
use lewiscowles\core\UlidRandomnessEncoder;
use lewiscowles\core\UlidTimeEncoder;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    const TIME = 1469918176385;

    protected function setup(): void
    {
        $this->ulid = new Ulid(
            new PHPTimeSource(),
            new UlidTimeEncoder(),
            new UlidRandomnessEncoder(
                new LcgRandomGenerator()
            )
        );
    }

    public function testRandIsBetween1and0()
    {
        $generator = new LcgRandomGenerator();
        $rand = $generator->generate();
        $this->assertTrue( $rand > 0 && $rand < 1 );
    }

    public function testNewUlidShouldReturnCorrectLength()
    {
        $hash = $this->ulid->get();
        $this->assertEquals(26, strlen($hash));
    }
}
