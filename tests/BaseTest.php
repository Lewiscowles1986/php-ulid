<?php

namespace lewiscowles\core\Tests;

use lewiscowles\core\Ulid;
use lewiscowles\core\Concepts\Time\PHPTimeSource;
use lewiscowles\core\Concepts\Time\UlidTimeEncoder;
use lewiscowles\core\Concepts\Random\Source\LcgRandomGenerator;
use lewiscowles\core\Concepts\Random\UlidRandomnessEncoder;
use lewiscowles\core\Concepts\Time\TimeSourceInterface;
use lewiscowles\core\Tests\Support\CannedTimeSource;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    protected function makeUlid(?TimeSourceInterface $timeSource = null)
    {
        return new Ulid(
            new UlidTimeEncoder(
                $timeSource ?? new CannedTimeSource(
                    rand(PHP_INT_MIN, PHP_INT_MAX)
                )
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
        $this->assertTrue($rand > 0 && $rand < 1);
    }

    public function testNewUlidShouldReturnCorrectLength()
    {
        $hash = $this->makeUlid(
            new PHPTimeSource()
        )->get();
        $this->assertEquals(26, strlen($hash));
    }

    /**
     * @dataProvider multipleRunsProvider
     */
    public function testNewUlidShouldOnlyReturnCharactersInRange()
    {
        $hash = $this->makeUlid()->get();
        $this->assertEquals(26, strlen($hash));
        $this->assertMatchesRegularExpression('/^[0-9A-HJKMNP-TV-Z]+$/', $hash);
    }

    public function multipleRunsProvider()
    {
        return array_fill(0, 99, [0]);
    }
}
