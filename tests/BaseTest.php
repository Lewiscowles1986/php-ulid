<?php

namespace lewiscowles\core\Tests;

use lewiscowles\core\Ulid;
use lewiscowles\core\LcgRandomGenerator;
use lewiscowles\core\PHPTimeSource;
use PHPUnit\Framework\TestCase;

class BaseTest extends TestCase
{

    const TIME = 1469918176385;

    protected function setup(): void
    {
        $this->ulid = new Ulid($this->getTimeSource(), $this->getLcgRandom());
    }

    public function getTimeSource()
    {
        return new PHPTimeSource();
    }

    public function getLcgRandom()
    {
        return new LcgRandomGenerator();
    }

    public function testRandIsBetween1and0()
    {
        $rand = $this->getLcgRandom()->generate();
        $this->assertTrue( $rand > 0 && $rand < 1 );
    }

    public function testEncodeTimeShouldReturnExpectedEncodedResult()
    {
        $hash = $this->invokeMethod($this->ulid, 'encodeTime', [self::TIME, 10]);
        $this->assertEquals("01ARYZ6S41", $hash);
    }

    public function testEncodeTimeShouldChangeLengthProperly()
    {
        $hash = $this->invokeMethod($this->ulid, 'encodeTime', [self::TIME, 12]);
        $this->assertEquals("0001ARYZ6S41", $hash);
    }

    public function testEncodeTimeShouldTruncateTimeIfNotLongEnough()
    {
        $hash = $this->invokeMethod($this->ulid, 'encodeTime', [self::TIME, 8]);
        $this->assertEquals("ARYZ6S41", $hash);
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
