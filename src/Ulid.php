<?php

namespace lewiscowles\core;

final class Ulid
{
    const ENCODING = '0123456789ABCDEFGHJKMNPQRSTVWXYZ';
    const ENCODING_LENGTH = 32;

    /** @var TimeSourceInterface */
    private $time_src;

    /** @var RandomFloatInterface */
    private $random_float_src;
    
    public function __construct(TimeSourceInterface $ts, RandomFloatInterface $rf)
    {
        $this->time_src = $ts;
        $this->random_float_src = $rf;
    }
    
    public function get(): string
    {
        return sprintf(
            '%s%s',
            $this->encodeTime($this->time_src->getTime(), 10),
            $this->encodeRandom(16)
        );
    }
    
    private function encodeTime(int $time, int $length): string
    {
        $out = '';
        while ($length > 0) {
            $mod = (int) ($time % self::ENCODING_LENGTH);           
            $out = self::ENCODING[$mod] . $out;
            $time = ($time - $mod) / self::ENCODING_LENGTH;
            $length--;
        }

        return $out;
    }
    
    private function encodeRandom(int $length): string
    {
        $out = '';
        while ($length > 0) {
            $rand = (int) floor(self::ENCODING_LENGTH * $this->random_float_src->generate());
            $out = self::ENCODING[$rand] . $out;
            $length--;
        }

        return $out;
    }
}
