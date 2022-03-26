<?php

namespace lewiscowles\core\Tests;

use lewiscowles\core\Ulid;
use lewiscowles\core\Concepts\Time\PHPTimeSource;
use lewiscowles\core\Concepts\Time\UlidTimeEncoder;
use lewiscowles\core\Concepts\Random\LcgRandomGenerator;
use lewiscowles\core\Concepts\Random\UlidRandomnessEncoder;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    const TIME = 1469918176385;

    protected function setup(): void
    {
        $this->ulid = new Ulid(
            new UlidTimeEncoder(
                new PHPTimeSource()
            ),
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
