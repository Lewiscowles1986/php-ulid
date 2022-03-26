<?php

namespace lewiscowles\core\Tests;

use lewiscowles\core\Ulid;
use lewiscowles\core\LcgRandomGenerator;
use lewiscowles\core\PHPTimeSource;
use lewiscowles\core\RandomFloatInterface;
use lewiscowles\core\TimeEncoderInterface;
use lewiscowles\core\TimeSourceInterface;
use lewiscowles\core\UlidTimeEncoder;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{
    const TIME = 1469918176385;

    protected function setup(): void
    {
        $this->ulid = new Ulid(
            $this->getTimeSource(),
            $this->getLcgRandom(),
            $this->getTimeEncoder()
        );
    }

    public function getTimeSource(): TimeSourceInterface
    {
        return new PHPTimeSource();
    }

    public function getLcgRandom(): RandomFloatInterface
    {
        return new LcgRandomGenerator();
    }

    public function getTimeEncoder(): TimeEncoderInterface
    {
        return new UlidTimeEncoder();
    }

    public function testRandIsBetween1and0()
    {
        $rand = $this->getLcgRandom()->generate();
        $this->assertTrue( $rand > 0 && $rand < 1 );
    }

    public function testEncodeRandomShouldReturnCorrectLength()
    {
        $length = 12;
        $hash = $this->invokeMethod($this->ulid, 'encodeRandom', [$length]);
        $this->assertEquals($length, strlen($hash));
    }

    public function testNewUlidShouldReturnCorrectLength()
    {
        $hash = $this->ulid->get();
        $this->assertEquals(26, strlen($hash));
    }

    protected function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invokeArgs($object, $parameters);
    }
}
