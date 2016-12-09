<?php

namespace lewiscowles\core;

final class Ulid {
    const ENCODING = "0123456789ABCDEFGHJKMNPQRSTVWXYZ";
    const ENCODING_LENGTH = 32;
    protected $random_float_src;
    
    public function __construct(RandomFloatInterface $rf){
        $this->random_float_src = $rf;
    }
    
    public function get()
    {
        return sprintf(
            "%s%s",
            $this->encodeTime($this->getTime(), 10),
            $this->encodeRandom(16)
        );
    }
    
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
    
    private function getTime() : int
    {
        return time();
    }
}

interface RandomFloatInterface {
    public function generate() : float;
}

class LcgRandomGenerator implements RandomFloatInterface {
    
    public function __construct() { }
    
    public function generate() : float {
        return lcg_value();
    }
}
