<?php

namespace lewiscowles\core;

/**
 * Class Ulid
 * @package lewiscowles\core
 */
final class Ulid {

    /**
     * @const string
     */
    const ENCODING = "0123456789ABCDEFGHJKMNPQRSTVWXYZ";

    /**
     * @const int
     */
    const ENCODING_LENGTH = 32;

    /**
     * @var TimeSourceInterface
     */
    protected $time_src;

    /**
     * @var RandomFloatInterface
     */
    protected $random_float_src;

    /**
     * Ulid constructor.
     * @param TimeSourceInterface $ts
     * @param RandomFloatInterface $rf
     */
    public function __construct(TimeSourceInterface $ts, RandomFloatInterface $rf) {
        $this->time_src = $ts;
        $this->random_float_src = $rf;
    }

    /**
     * @return string
     */
    public function get()
    {
        return sprintf(
            "%s%s",
            $this->encodeTime($this->time_src->getTime(), 10),
            $this->encodeRandom(16)
        );
    }

    /**
     * @param int $time
     * @param int $length
     * @return string
     */
    private function encodeTime(int $time, int $length) : string
    {
        $out = '';
        while($length > 0) {
            $mod = intval($time % self::ENCODING_LENGTH);
            
            $out = self::ENCODING[$mod] . $out;
            $time = ($time - $mod) / self::ENCODING_LENGTH;
            $length--;
        }
        return $out;
    }

    /**
     * @param int $length
     * @return string
     */
    private function encodeRandom(int $length) : string
    {
        $out = '';
        while($length > 0) {
            $rand = intval(
                floor(
                    self::ENCODING_LENGTH
                    *
                    $this->random_float_src->generate()
                )
            );
            $out = self::ENCODING[$rand] . $out;
            $length--;
        }
        return $out;
    }
}

/**
 * Interface RandomFloatInterface
 * @package lewiscowles\core
 */
interface RandomFloatInterface {
    public function generate() : float;
}

/**
 * Class LcgRandomGenerator
 * @package lewiscowles\core
 */
class LcgRandomGenerator implements RandomFloatInterface {
    
    public function __construct() { }
    
    public function generate() : float {
        return lcg_value();
    }
}

/**
 * Interface TimeSourceInterface
 * @package lewiscowles\core
 */
interface TimeSourceInterface {
    public function getTime() : int;
}

/**
 * Class PHPTimeSource
 * @package lewiscowles\core
 */
class PHPTimeSource implements TimeSourceInterface {

    /**
     * PHPTimeSource constructor.
     */
    public function __construct() { }

    /**
     * @return int
     */
    public function getTime() : int {
        return time();
    }
}
