<?php

namespace lewiscowles\core;

final class Ulid {
    const ENCODING = "0123456789ABCDEFGHJKMNPQRSTVWXYZ";
    const ENCODING_LENGTH = 32;
    
    public function get()
    {
        return $this->encodeTime($this->getTime(), 10) . $this->encodeRandom(16);
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
            $rand = intval(floor(self::ENCODING_LENGTH * $this->getRand()));
            $out = self::ENCODING[$rand] . $out;
            $length--;
        }
        return $out;
    }
    
    private function getRand() : float
    {
        return lcg_value();
    }
    
    private function getTime() : int
    {
        return time();
    }
}
